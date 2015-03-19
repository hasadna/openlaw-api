<?php

class Task_Migrate_Justice_Old extends Minion_Task
{
    public function _execute(array $params)
    {
        $uri_format = 'http://law.resource.org.il/v0/booklet/year/%d';
        $booklet_log_format = 'Migrating booklet: %d';
        $years = range(2005, 2015);

        $gmt_data_time_zone = new DateTimeZone('GMT');

        foreach ($years as $year) {
            $uri = sprintf($uri_format, $year);
            $request = Request::factory($uri);
            $json = $request->execute()->body();
            $data = json_decode($json, TRUE);

            foreach ($data['response'] as $booklet) {
                Minion_CLI::write(sprintf($booklet_log_format, $booklet['booklet']));
                $published = 0;
                if (isset($booklet['dates']['published'])) {
                    $published = (new DateTime($booklet['dates']['published'], $gmt_data_time_zone))->format('U');
                }

                /** @var Model_Knesset_Old_Law $entry */
                $entry = ORM::factory('Justice_Law');
                $entry->booklet = $booklet['booklet'];
                $entry->published = $published;
                $entry->description = $booklet['origin']['justice_description'];
                $entry->pdf_file = $booklet['links']['justice_pdf'];
                $entry->origin = json_encode($booklet);
                $entry->created = $booklet['created'];
                $entry->updated = REQUEST_TIME;
                $entry->save();
            }

        }

        Minion_CLI::write('Done migrating');
    }
}
