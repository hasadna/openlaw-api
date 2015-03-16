<?php

class Task_Migrate_Knesset_Old extends Minion_Task
{
    protected function _execute(array $params)
    {
        $uri_format = 'http://law.resource.org.il/v0/booklet/knesset/%d';
        $booklet_log_format = 'Migrating booklet: %d';
        $part_log_format = 'Migrating part: %d';
        $knesset_numbers = range(1, 19);
        foreach ($knesset_numbers as $knesset_number) {
            $uri = sprintf($uri_format, $knesset_number);
            $request = Request::factory($uri)
                ->query('part', 1);
            $json = $request->execute()->body();
            $data = json_decode($json, true);
            foreach ($data['response'] as $booklet) {
                Minion_CLI::write(sprintf($booklet_log_format, $booklet['booklet']));
                if (!empty($booklet['parts'])) {
                    foreach ($booklet['parts'] as $part) {
                        Minion_CLI::write(sprintf($part_log_format, $part['origin']['knesset_part']));
                        /** @var Model_Knesset_Old_Law $entry */
                        $entry = ORM::factory('Knesset_Old_Law');
                        $entry->booklet = $part['booklet'];
                        $entry->part = $part['origin']['knesset_part'];
                        $entry->knesset = $booklet['knesset'];
                        $entry->title = $part['origin']['knesset_title'];
                        $entry->pdf_file = $part['links']['knesset_pdf'];
                        $entry->origin = json_encode($part);
                        $entry->created = $part['created'];
                        $entry->save();
                    }
                }
            }
        }
        Minion_CLI::write('Done migrating');
    }
}
