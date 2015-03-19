<?php

class Task_Migrate_Knesset_New extends Minion_Task
{
    protected function _execute(array $params)
    {
        $this->_execute_primary();
        $this->_execute_secondary();
        $this->_execute_amendment();
        $this->_execute_wiki_pages();
    }

    protected function _execute_primary()
    {
        $new_primaries = ORM::factory('Laws_Primary')
          ->find_all();

        foreach ($new_primaries as $new_primary) {
            /** @var Model_Laws_Primary $new_primary */
            /** @var Model_Knesset_New_Primary $primary */
            Minion_CLI::write('Migrating primary law: ' . $new_primary->id);

            $published = 0;
            if (strpos($new_primary->published, '/') !== FALSE) {
                list ($day, $month, $year) = explode('/', $new_primary->published);
                $published = gmmktime(0, 0, 0, $month, $day, $year);
            }
            $amended = 0;
            if (strpos($new_primary->amended, '/') !== FALSE) {
                list ($day, $month, $year) = explode('/', $new_primary->amended);
                $amended = gmmktime(0, 0, 0, $month, $day, $year);
            }

            $primary = ORM::factory('Knesset_New_Primary');
            $primary->id = $new_primary->id;
            $primary->name = $new_primary->name;
            $primary->knesset_id = $new_primary->knesset_id;
            $primary->assignee = $new_primary->responsible;
            $primary->link = $new_primary->link;
            $primary->published = $published;
            $primary->amended = $amended;
            $primary->origin = json_encode($new_primary->as_array());
            $primary->created = $new_primary->created;
            $primary->updated = REQUEST_TIME;
            $primary->save();
        }
    }

    protected function _execute_secondary()
    {
        $new_secondaries = ORM::factory('Laws_Secondary')
          ->find_all();

        foreach ($new_secondaries as $new_secondary) {
            /** @var Model_Laws_Secondary $new_secondary */
            /** @var Model_Knesset_New_Secondary $secondary */
            Minion_CLI::write('Migrating secondary law: ' . $new_secondary->id);

            $published = 0;
            if (strpos($new_secondary->published, '/') !== FALSE) {
                list ($day, $month, $year) = explode('/', $new_secondary->published);
                $published = gmmktime(0, 0, 0, $month, $day, $year);
            }

            $secondary = ORM::factory('Knesset_New_Secondary');
            $secondary->id = $new_secondary->id;
            $secondary->name = $new_secondary->name;
            $secondary->knesset_id = $new_secondary->knesset_id;
            $secondary->link = $new_secondary->link;
            $secondary->booklet_type = $new_secondary->booklet_type;
            $secondary->booklet_number = $new_secondary->booklet_number;
            $secondary->booklet_page = $new_secondary->booklet_page;
            $secondary->published = $published;
            $secondary->file_path = $new_secondary->file_path;
            $secondary->knesset_number = $new_secondary->knesset_number;
            $secondary->bill_type = $new_secondary->bill_type;
            $secondary->bill_id = $new_secondary->bill_id;
            $secondary->origin = json_encode($new_secondary->as_array());
            $secondary->created = $new_secondary->created;
            $secondary->updated = REQUEST_TIME;
            $secondary->save();
        }

    }

    protected function _execute_amendment()
    {
        $new_amendments = ORM::factory('Laws_Amendment')
          ->find_all();

        foreach ($new_amendments as $new_amendment) {
            /** @var Model_Laws_Amendment $new_amendment */
            /** @var Model_Knesset_New_Amendment $amendment */
            Minion_CLI::write('Migrating amendment: ' . implode(':', $new_amendment->as_array()));

            $amendment = ORM::factory('Knesset_New_Amendment');
            $amendment->knesset_new_primary_id = $new_amendment->laws_primary_id;
            $amendment->knesset_new_secondary_id = $new_amendment->laws_secondary_id;
            $amendment->save();
        }
    }

    protected function _execute_wiki_pages()
    {
        $laws_wiki_pages = ORM::factory('Laws_WikiPage')
          ->find_all();

        foreach ($laws_wiki_pages as $laws_wiki_page) {
            /** @var Model_Laws_WikiPage $laws_wiki_page */
            /** @var Model_Wiki_page $wiki_page */
            Minion_CLI::write('Migrating wiki page: ' . $laws_wiki_page->wiki_id);

            $wiki_page = ORM::factory('Wiki_Page');
            $wiki_page->id = $laws_wiki_page->id;
            $wiki_page->knesset_new_primary_id = $laws_wiki_page->laws_primary_id;
            $wiki_page->title = $laws_wiki_page->title;
            $wiki_page->wiki_id = $laws_wiki_page->wiki_id;
            $wiki_page->last_updated = $laws_wiki_page->last_updated;
            $wiki_page->created = $laws_wiki_page->created;
            $wiki_page->updated = REQUEST_TIME;
            $wiki_page->save();
        }

    }
}
