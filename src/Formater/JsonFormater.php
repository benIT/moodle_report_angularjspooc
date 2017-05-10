<?php

namespace ReportManager\Formater;


class JsonFormater implements FormaterInterface
{
    /**
     * format to json
     * @param $data
     * @return array
     */
    public function format($data)
    {
        $json = [];
        foreach ($data as $record) {
            $json[] = $record;
        }
        return $json;
    }
}