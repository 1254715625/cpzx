<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-type:text/html;charset=utf-8');

class Api extends MY_Controller
{

    //首页返回类型内容
    /**
     * @param string $status 1普通新闻  3轮播新闻
     * @param string $type_id   获取新闻分类  如1欢乐精选
     * @param string $id      获取具体的新闻
     *
     *
     *
     */
    public function get_content($status = '', $type_id = '', $id = '')
    {


        $status = $_GET['status'];//状态
        $type_id = $_GET['type_id']; //类型
        $id = $_GET['id'];           //查询具体

        $page = $_GET['page'] ? $_GET['page'] : 1;
        $size = $_GET['size'] ? $_GET['size'] : 10;

        $sql = "select a.id,a.img ,a.title,a.shorttitle,a.click,a.newstime,c.content,c.local_time from tx_news as a,tx_news_type as b ,tx_news_content as c ,tx_news_status as d where a.typeid=b.id and a.id=c.id and a.status = d.id";

        $cou = "select count(*) as total from tx_news as a,tx_news_type as b ,tx_news_content as c ,tx_news_status as d where a.typeid=b.id and a.id=c.id and a.status = d.id";

        if ($status && $type_id) {   //获取轮播图   状态和类型一起确定

            $count = $this->db->query($cou . " and a.status =" . $status ."  and b.id= ".$type_id."  ");
            $num = $count->result_array()[0]['total'];
            $total = ceil($num / $size);
            $query = $this->db->query($sql . " and a.status =" . $status . " and b.id= ".$type_id."  limit " . (($page - 1) * $size) . ", " . $size);

        } elseif ($type_id && $id == '') {   //获取类型

            $count = $this->db->query($cou . " and b.id =" . $type_id);
            $num = $count->result_array()[0]['total'];
            $total = ceil($num / $size);

            $query = $this->db->query($sql . " and b.id =" . $type_id . " limit " . (($page - 1) * $size) . " , " . $size);

        } elseif ($id) {   //获取具体新闻

            $getdata = $this->data_model;
            $arr = $getdata->get_vote($id);
            foreach ($arr as $val) {
                if ($val['vote'] == 1) {
                    $vote[] = $val;
                } else if ($val['dvote'] == 0) {
                    $dvote[] = $val;
                }

            }
            $vnum = count($vote);
            $dnum = count($dvote);

            $num=1;
            $total=1;
            $query = $this->db->query($sql . " and a.id =" . $id . " ");
            $results = $query->result_array();
            $rand = rand(1, 6);
            $secord = $this->db->query($sql . " and b.id =" . $rand . " limit 0,3");
            $addes = $secord->result_array();
            foreach ($results as $key => $val) {
                $results[$key]['vnum'] = $vnum;
                $results[$key]['dnum'] = $dnum;
            }

            $results = array(
                'head' => $results,
                'foot' => $addes
            );

        } else { //默认获取所有的新闻
            $query = $this->db->query($sql);
        }

        if (!$id) {
            $results = $query->result_array();
        }

        if ($results) {
            $res = array(
                'mes' => '返回成功',
                'status' => 1,
                'num' => $num,
                'total' => $total,
                'result' => $results
            );
        }

        echo json_encode($res);

    }


    //美女图片

    /**
     * @param $id 美女id，获取具体的图片内容
     * 如果不传id，默认为获取分页图片
     * @param $num 美女id， 总数
     * @param $total        总页码
     */
    public function img($id = '')
    {
        error_reporting(E_ERROR);

        if($id ==''){
            $id = $_GET['id'];
        }
        $page = $_GET['page'] ? $_GET['page'] : 1;
        if (!$id) {

            $status = $_GET['status'];
            $date = $_GET['date'];
            $keywords = $_GET['keywords'];
            $size = $_GET['size'] ? $_GET['size'] : 10;

            $getdata = $this->data_model;

            $imginfo = $getdata->get_imgmanage($status, $date, $keywords, $page, $size);

            //$url = $this->da['url_dir'].'/api/img?status='.$status.'&date='.$date.'&keywords='.$keywords;
            //$fenye = fenye($page,10,$imginfo['num'],$url);
            // $this->da['fenye'] = $fenye;

            $total = ceil($imginfo['num'] / $size);
            $da = array(
                'status' => $status,
                'keywords' => $keywords,
                'date' => $date,
                'imginfo' => $imginfo['data'],
            );

            $arr = array(
                'status' => 1,
                'msg' => '返回成功',
                'num'=>$imginfo['num'],
                'total'=>$total,
                'result' => $da,
            );

        } else {
            $getdata = $this->data_model;
            $info = $getdata->get_img($id);
            $content = $getdata->get_imgcontent($id);
            $prenext = $getdata->get_imgpn($id);
            $this->da['info'] = $info;
            $this->da['content'] = json_decode($content);
            $this->da['pre'] = $prenext['pre'];
            $this->da['next'] = $prenext['next'];

            $arr = array(
                'info' => $info,
                'content' => json_decode($content),
                'pre' => $prenext['pre'],
                'next' => $prenext['next'],
            );
        }

        echo json_encode($arr);
    }


    /**
     * 点赞处理
     * @param $id  当前对象ID
     * @param $status 0:踩  1:赞
     */
    public function zan($id = '', $status = '')
    {
        $id = $_GET['id'];
        $status = $_GET['status'];
        if (!$id || $status == '') {
            $msg = "参数不全";
            $status = 0;
            $res = array(
                'msg' => $msg,
                'status' => $status
            );
            echo json_encode($res);
            die;
        }
        $ip = getIP();
        $getdata = $this->data_model;
        $data = $getdata->get_vote_ip($id, $ip);
        $msg = "";
        if ($status == 0 && isset($status)) {
            if (empty($data['ip']) || !$data['ip']) {
                $data = array('nid' => $id, 'dvote' => 0, 'ip' => $ip);
                $re = $getdata->insert_vote($data);
                $msg .= "踩成功";
                $status = 1;
            } else {
                $msg .= "一个ip只能操作一次";
                $status = 0;
            }
        } elseif ($status == 1) {
            if (empty($data['ip']) || !$data['ip']) {
                $data = array('nid' => $id, 'vote' => 1, 'ip' => $ip);
                $re = $getdata->insert_vote($data);
                $msg .= "点赞成功";
                $status = 1;
            } else {
                $msg .= "一个ip只能操作一次";
                $status = 0;
            }
        }
        $res = array(
            'msg' => $msg,
            'status' => $status
        );

        echo json_encode($res);
    }




    //其他信息
    /**
     * 默认 返回所有分类
     * @param $day_type 1 日排行榜  2周排行榜
     * @param $page      页码
     * @return string
     */
    public function get_other($day_type = '')
    {
        if($day_type == ''){
            $day_type = $_GET['day_type'];
        }

        $page = $_GET['page'] ? $_GET['page'] : 1;
        $size=$_GET['size']?$_GET['size']:10;
        $getdata = $this->data_model;
        $day = $getdata->get_allnews("where status != 0 and to_days(addtime) = to_days(now()) limit " . (($page - 1) * $size) . ",".$size);
        $week = $getdata->get_allnews("where status != 0 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(addtime) limit " . (($page - 1) * $size) . ",".$size);
        $countday=$this->db->query("select count(*) as total from tx_news where status != 0 and to_days(addtime) = to_days(now())");
        $countweek=$this->db->query("select count(*) as total from tx_news where status != 0 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(addtime)");

        $day_num = $countday->result_array()[0]['total'];
        $week_num = $countweek->result_array()[0]['total'];

        if ($day_type == 1) {
            $arr = array(
                'status' => 1,
                'msg' => '返回成功',
                'num'=>$day_num,
                'total'=>ceil($day_num/$size),
                'res' => $day
            );
        } elseif ($day_type == 2) {
            $arr = array(
                'status' => 1,
                'msg' => '返回成功',
                'num'=>$week_num,
                'total'=>ceil($week_num/$size),
                'res' => $week
            );
        } else {
            $query = $this->db->query("select id, name from  tx_news_type");
            $result = $query->result_array();
            $arr = array(
                'status' => 1,
                'msg' => '返回成功',
                'res' => $result
            );
        }

        echo json_encode($arr);
    }


}
