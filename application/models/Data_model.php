<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /************************************ 信息获取 ******************************************/

    //获取网站信息
    public function get_webinfo(){

        $query = $this->db->query('select * from tx_config');
        $info = $query->result_array();

        return em($info);
    }

    //获取热门标签
    public function get_newtag(){

        $query = $this->db->query('select * from tx_news_tag order by click desc limit 5');
        $tag = $query->result_array();

        return em($tag);
    }

    //获取新闻信息
    public function get_new($id=''){

        if($id){
            $addsql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_news '.$addsql);
        $info = $query->result_array()[0];

        return em($info);
    }

    //获取新闻内容
    public function get_newcontent($id){

        $query = $this->db->query('select content from tx_news_content where id ='.$id);
        $content = $query->result_array()[0]['content'];
        return em($content);
    }


    //获取视频新闻内容
    public function get_video_content($id){

        $query = $this->db->query('select content from tx_news_content where id ='.$id);
        $content = $query->result_array()[0]['content'];
        $result=explode('.',$content);

        if(!$result){
            return false;
        }

        $total=count($result);
        $diz=$result[($total-1)];

        if(in_array($diz,['3gp','rmvb','flv','mp4','wmv','avi','mkv','wav'])){
            return em($content);
        }

        return false;

    }

    //获取图集信息
    public function get_img($id=''){

        if($id){
            $addsql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_img '.$addsql);
        $info = $query->result_array()[0];

        return em($info);
    }

    //获取图集内容
    public function get_imgcontent($id){

        $query = $this->db->query('select content from tx_img_content where id ='.$id);
        $content = $query->result_array()[0]['content'];

        return em($content);
    }

    //获取新闻类型
    public function get_newtype($id=''){

        if($id){
            $addsql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_news_type '.$addsql);
        $type = $query->result_array();

        return em($type);
    }

	//获取广告类型
    public function get_ad($id=''){

        if($id){
            $addsql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_ad '.$addsql);
        $type = $query->result_array();

        return em($type);
    }
	
    //获取新闻状态
    public function get_newstatus($id=''){

        if($id){
            $addsql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_news_status '.$addsql);
        $status = $query->result_array();

        return em($status);
    }

    //获取轮播文章信息
    public function get_advnew(){

        $query = $this->db->query('select tn.*,tt.name from tx_news tn left join tx_news_type tt on tn.typeid = tt.id where tn.status = 3 order by tn.id desc limit 10 ');
        $listdata = $query->result_array();

        return em($listdata);
    }

    //分类获取新闻信息
    public function get_newmanage($typeid,$status,$date,$keywords,$page){
        $addsql = '1 = 1';

        if(is_numeric($typeid)){
            $addsql .= ' and tn.typeid = '.$typeid;
        }

        if(is_numeric($status)){
            $addsql .= ' and tn.status = '.$status;
        }

        if($date){
            $addsql .= ' and tn.newstime like "'.$date.'%"';
        }

        if($keywords){
            $addsql .= ' and tn.title like "%'.$keywords.'%"';
        }

        $query = $this->db->query( "select count(*) as dd from tx_news tn where ".$addsql);
        $data['num'] = $query->result_array()[0]['dd'];

        $query = $this->db->query( "select tn.*,tnt.name from tx_news tn left join tx_news_type tnt on tnt.id = tn.typeid where ".$addsql." order by tn.id desc limit ".(($page-1)*10).",10");
        $data['data'] = $query->result_array();

        return $data;
    }



    /*    //分类获取图集信息  //老版的
    public function get_imgmanage($status,$date,$keywords,$page){
        $addsql = '1 = 1';

        if(is_numeric($status)){
            $addsql .= ' and status = '.$status;
        }

        if($date){
            $addsql .= ' and addtime like "'.$date.'%"';
        }

        if($keywords){
            $addsql .= ' and title like "%'.$keywords.'%"';
        }

        $query = $this->db->query( "select count(*) as dd from tx_img where ".$addsql);
        $data['num'] = $query->result_array()[0]['dd'];

        $query = $this->db->query( "select * from tx_img  where ".$addsql." order by id desc limit ".(($page-1)*10).",10");
        $data['data'] = $query->result_array();

        return $data;
    }*/


    //分类获取图集信息  //新版
    public function get_imgmanage($status,$date,$keywords,$page,$size =''){
        $addsql = '1 = 1';
        if($size == ''){
            $size=$_GET['size']?$_GET['size']:10;
        }
        if(is_numeric($status)){
            $addsql .= ' and status = '.$status;
        }

        if($date){
            $addsql .= ' and addtime like "'.$date.'%"';
        }

        if($keywords){
            $addsql .= ' and title like "%'.$keywords.'%"';
        }

        $query = $this->db->query( "select count(*) as dd from tx_img where ".$addsql);
        $data['num'] = $query->result_array()[0]['dd'];

        $query = $this->db->query( "select * from tx_img  where ".$addsql." order by id desc limit ".(($page-1)*$size).",".$size);
        $data['data'] = $query->result_array();

        return $data;
    }



    //前端部分
    //广域获取新闻信息
    function get_allnews($addsql){

        $query = $this->db->query( "select * from tx_news ".$addsql);
        $data = $query->result_array();

        return $data;
    }

    //首页新闻显示
    public function get_type(){

        $query = $this->db->query('select * from tx_news_type where status=0 order by sort asc');
        $type = $query->result_array();

        return em($type);
    }

    //获取图集信息
    function get_allimg(){

        $query = $this->db->query( "select * from tx_img where status != 2 order by addtime desc ");
        $data = $query->result_array();
        return $data;
    }

    //获取彩票咨询信息
    function get_cpzx(){

        for($i = 2;$i<8;$i++){
            $query = $this->db->query( "select tn.*,tnt.name as typename from tx_news tn left join tx_news_type tnt on tnt.id = tn.typeid where tn.status != 0 and tn.typeid = ".$i." order by tn.addtime desc limit 5 ");
            $data[] = $query->result_array();
        }
        return $data;
    }

    //获取新闻list
    public function get_list($typeid,$page){
       // $addsql = 'status != 0';
        $addsql = 'status != 0 and status !=3 ';

        if(is_numeric($typeid)){
            $addsql .= ' and typeid = '.$typeid;
        }

        $query = $this->db->query( "select count(id) as dd from tx_news where ".$addsql);
        $data['num'] = $query->result_array()[0]['dd'];

        $query = $this->db->query( "select id,title,img,abstract,newstime,source from tx_news where ".$addsql." order by id desc limit ".(($page-1)*10).",10");
        $data['data'] = $query->result_array();

        return $data;
    }

    //获取新闻内容
    public function get_content($id){

        $query = $this->db->query( "select id,title,abstract,newstime,click,source from tx_news where id = ".$id);
        $data['info'] = $query->result_array()[0];

        $query = $this->db->query( "select content ,local_time from tx_news_content where id = ".$id);
        $data['content'] = $query->result_array()[0];
         return $data;
        
    }
    //获取点赞ip信息
    public function get_vote_ip($id,$ip){

        $query=$this->db->query("select * from tx_vote where nid='{$id}' and ip='{$ip}'");
        $data=$query->result_array()[0];

        return $data;
    }

    //获取点赞信息
    public function get_vote($id){
        $query=$this->db->query("select * from tx_vote where nid='{$id}'");
        $data=$query->result_array();
        return $data;
    }

    //获取新闻上下篇
    public function get_prenext($id,$typeid){

        $query = $this->db->query( "select id,title from tx_news where id = (select id from tx_news where id < ".$id." and typeid=".$typeid." order by id desc limit 1)");
        $data['pre'] = $query->result_array()[0];

        $query = $this->db->query( "select id,title from tx_news where id = (select id from tx_news where id > ".$id." and typeid=".$typeid." order by id desc limit 1)");
        $data['next'] = $query->result_array()[0];

        return $data;
    }


    //获取图集上下篇
    public function get_imgpn($id){

        $query = $this->db->query( "select id,title,img from tx_img where id = (select id from tx_img where id < ".$id."  order by id desc limit 1)");
        $data['pre'] = $query->result_array()[0];

        $query = $this->db->query( "select id,title,img from tx_img where id = (select id from tx_img where id > ".$id."  order by id desc limit 1)");
        $data['next'] = $query->result_array()[0];

        return $data;
    }

    //搜索信息
    public function get_search($keywords,$page,$type='search'){
        $addsql = 'status != 0';

        if($keywords && $type=='search'){
            $addsql .= ' and title like "%'.$keywords.'%"';
        }else if($keywords && $type=='tag'){
            $addsql .= ' and tag like "%'.$keywords.'%"';
        }

        $query = $this->db->query( "select count(*) as dd from tx_news where ".$addsql);
        $data['num'] = $query->result_array()[0]['dd'];

        $query = $this->db->query( "select * from tx_news where ".$addsql." order by id desc limit ".(($page-1)*10).",10");
        $data['data'] = $query->result_array();

        return $data;
    }

    //获取友情链接
    public function get_f_link($page){
            $query = $this->db->query( "select count(*) as dd from tx_f_link");
            $data['num'] = $query->result_array()[0]['dd'];

            $query = $this->db->query("select * from tx_f_link order by sort asc limit ".(($page-1)*6).",6");
            $data['data'] = $query->result_array();

            return em($data);
    }

    public function get_f_link_all(){
        $query = $this->db->query("select * from tx_f_link order by sort asc");
        $data = $query->result_array();

        return em($data);
    }

    public function get_f_linkinfo($id){
        if($id){
            $infosql = ' where id = '.$id;
        }

        $query = $this->db->query('select * from tx_f_link '.$infosql);
        $type = $query->result_array();

        return em($type);
    }



    /************************************* 信息检测 *********************************************/

    function check_tag($string){
        $query = $this->db->query( "select count(*) as dd from tx_news_tag where tagname = '".$string."' ");
        $num = $query->result_array()[0]['dd'];

        if($num>0){
            return false;
        }else{
            return true;
        }
    }



    /************************************ 信息更新 **********************************************/

    //新闻更新
    public function update_new($data,$id){
        $this->db->where('id', $id);
        $data = $this->db->update('tx_news', $data);

        return $data;
    }

    //新闻内容更新
    public function update_newcontent($data,$id){
        $this->db->where('listid', $id);
        $data = $this->db->update('tx_news_content', $data);

        return $data;
    }

    //图集更新
    public function update_img($data,$id){
        $this->db->where('id', $id);
        $data = $this->db->update('tx_img', $data);

        return $data;
    }

    //图集内容更新
    public function update_imgcontent($data,$id){
        $this->db->where('listid', $id);
        $data = $this->db->update('tx_img_content', $data);

        return $data;
    }

    //栏目更新
    public function update_newtype($data,$id){
        $this->db->where('id', $id);
        $data = $this->db->update('tx_news_type', $data);

        return $data;
    }
	
	//广告更新
    public function update_ad($data,$id){
        $this->db->where('id', $id);
        $data = $this->db->update('tx_ad', $data);

        return $data;
    }

    //点击更新
    public function update_click($id){

        $query = $this->db->query( "select typeid,tag from tx_news where id = ".$id);
        $info = $query->result_array()[0];

        $data = $info['typeid'];

        //更新文章click
        $this->db->query( "UPDATE tx_news SET click = click+1 WHERE id = ".$id);

        $arr2 = explode(',',$info['tag']);

        foreach($arr2 as $val){
            $this->db->query( "UPDATE tx_news_tag SET click = click+1 WHERE tagname = '".$val."'");
        }

        return $data;
    }

    //友情链接更新
    public function update_f_link($data,$id){
        $this->db->where('id', $id);
        $data = $this->db->update('tx_f_link', $data);
        return $data;
    }

    /************************************ 信息注册 *********************************************/

    //点赞添加
    public function insert_vote($data){
        $data=$this->db->insert("tx_vote",$data);
        return $data; 
    }
    //新闻添加
    public function insert_new($data){

        $this->db->insert('tx_news', $data);
        return $this->db->insert_id();
    }

    //新闻内容添加
    public function insert_newcontent($data){

        $data = $this->db->insert('tx_news_content', $data);

        return $data;
    }

    //图集添加
    public function insert_img($data){

        $this->db->insert('tx_img', $data);
        return $this->db->insert_id();
    }

    //图集内容添加
    public function insert_imgcontent($data){

        $data = $this->db->insert('tx_img_content', $data);

        return $data;
    }

    //栏目添加
    public function insert_newtype($data){

        $this->db->insert('tx_news_type', $data);
        return $this->db->insert_id();

    }
    
     //标签添加
     public function insert_newtag($data){

            $this->db->insert('tx_news_tag', $data);
            return $this->db->insert_id();

    }

        //友情链接添加
        public function insert_f_link($data){
            $this->db->insert('tx_f_link' , $data);
            return $this->db->insert_id();
        }


    /************************************ 信息删除 *********************************************/

    public function del_index($string,$where){

        $data = $this->db->query("delete from {$string} where ".$where);

        return $data;
    }


}