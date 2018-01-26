<?php
namespace Admin\Controller;
class ProblemController extends BaseController {
	//题目总览
    public function index(){
    	$problem=M("problem")->order("add_time desc")->select();

    	$this->assign("problem",$problem);
    	$this->display();
    }

    //添加页面
    public function add(){

    	$this->display();
    }

    //添加
    public function add_do(){
        $time=strtotime($_POST['add_time'])+1;
        //查询今日是否已经添加过题目
        $info=M("problem")->where("add_time='$time'")->find();
        if($info){
            echo "<script type='text/javascript'>alert('当前日期已添加题目');window.history.go(-1);</script>";
        }else{
            //上传图片
            $upload=new \Think\Upload();
            $upload->maxSize=20971520;//设置附件上传大小20M
            $upload->exts=array('jpg','jpeg','png','gif');//设置附件上传类型
            $upload->rootPath="./pub/upload/";//设置附件上传目录 文件上传保存的根路径
            $upload->savePath="AdminImages/";//设置附件上传目录  文件上传的保存路径（相对于根路径）
            $info=$upload->upload();
            if($info){
                foreach ($info as $k=>$v){
                    $arr[$k]['news_img']=$v['savepath'].$v['savename'];//遍历得到路径
                }
                $data['title']=$_POST['title'];
                $data['video_result']=$_POST['video_result'];
                $data['content']=$arr['0']['news_img'];
                $data['result']=$arr['1']['news_img'];
                $data['add_time']=strtotime($_POST['add_time'])+1;
                $data['datetime']=$_POST['add_time'];
                $res=M("problem")->add($data);
                if($res){
                    echo "<script type='text/javascript'>alert('添加成功');window.location='/admin.php/Problem/add'; </script>";
                }else{
                    echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
                }   
            }
        }
    }

    //修改页面
    public function mod($id){
    	$problem=M("problem")->where("id='$id'")->find();

    	$this->assign("problem",$problem);
    	$this->display();
    }

    //修改
    public function mod_do($id){
         //上传图片
        $upload=new \Think\Upload();
        $upload->maxSize=20971520;//设置附件上传大小20M
        $upload->exts=array('jpg','jpeg','png','gif');//设置附件上传类型
        $upload->rootPath="./pub/upload/";//设置附件上传目录 文件上传保存的根路径
        $upload->savePath="AdminImages/";//设置附件上传目录  文件上传的保存路径（相对于根路径）
        $info=$upload->upload();
        if($info){
            foreach ($info as $k=>$v){
                    $arr[$k]['news_img']=$v['savepath'].$v['savename'];//遍历得到路径
                } 
            $data['title']=$_POST['title'];
            $data['video_result']=$_POST['video_result'];
            $data['content']=$arr['0']['news_img'];
            $data['result']=$arr['1']['news_img'];
            $res=M("problem")->where("id='$id'")->save($data);
            if($res){
                echo "<script type='text/javascript'>alert('修改成功');window.location='/admin.php/Problem/index'; </script>";
            }else{
                echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
            }
        }else{
			$data['title']=$_POST['title'];
            $data['video_result']=$_POST['video_result'];
			$res=M("problem")->where("id='$id'")->save($data);
            if($res){
                echo "<script type='text/javascript'>alert('修改成功');window.location='/admin.php/Problem/index'; </script>";
            }else{
                echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
            }
		}
        
    }

    //删除题目
    public function del($id){
    	$res=M("problem")->where("id='$id'")->delete();
    	if($res){
    		echo "<script type='text/javascript'>alert('删除成功');window.location='/admin.php/Problem/index'</script>";
    	}else{
    		echo "<script type='text/javascript'>alert('服务器繁忙,稍后再试');window.history.back();</script>";
    	}
    }

    //答题详情
    public function answer($id){
        $info=M("submit a,class_problem b,class_student c")->field("b.title,c.wx_name,a.id")->where("a.problem_id=b.id and a.user_id=c.id and a.problem_id='$id'")->select();

        $this->assign("info",$info);
        $this->display();
    }

    //答题详情之图片
    public function answer_see($id){
        $info=M("submit")->where("id='$id'")->find();

        $this->assign("info",$info);
        $this->display();
    }
}