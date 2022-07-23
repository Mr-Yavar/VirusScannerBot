<?php

namespace nguyenanhung\Tool\DrVirus;

/**
 * Class Comment
 *
 * @package   nguyenanhung\Tool\DrVirus
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Comment extends Base
{
    /**
     * Function addComment
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:46
     *
     * @param $resource
     * @param $comment
     *
     * @return mixed
     */
    public function addComment($resource, $comment)
    {
        $data = $this->makePostRequest('comments/put', array(
            'resource' => $resource,
            'comment'  => $comment,
            'apikey'   => $this->_apiKey,
        ));

        return $data;
    }
}
