<?php

namespace nguyenanhung\Tool\DrVirus;

/**
 * Class File
 *
 * @package   nguyenanhung\Tool\DrVirus
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class File extends Base
{
    /**
     * Function scan
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:45
     *
     * @param $file
     *
     * @return mixed
     */
    public function scan($file)
    {
        $data = $this->makePostRequest('file/scan', [
            [
                'name'     => 'file',
                'contents' => fopen($file, 'r'),
                'filename' => basename($file)
            ],
            [
                'name'     => 'apikey',
                'contents' => $this->_apiKey
            ]
        ], 'multipart');

        return $data;
    }

    /**
     * Function reScan
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:46
     *
     * @param $resource
     *
     * @return mixed
     */
    public function reScan($resource)
    {
        $data = $this->makePostRequest('file/rescan', array(
            'resource' => $resource,
            'apikey'   => $this->_apiKey,
        ));

        return $data;
    }

    /**
     * Function getReport
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:45
     *
     * @param $resource
     *
     * @return mixed
     */
    public function getReport($resource)
    {
        $data = $this->makePostRequest('file/report', array(
            'resource' => $resource,
            'apikey'   => $this->_apiKey,
        ));

        return $data;
    }
}
