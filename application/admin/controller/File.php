<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/9
 * Time: 9:44
 */

namespace app\admin\controller;


class File extends Common
{
    public function index($currdir=null)
    {
//        $currdir=urldecode($currdir);

//        $currdir=iconv('UTF-8','GB2312',$currdir);
        if($currdir){
            if(file_exists($currdir)){
                //查看权限限制
                if(stripos($currdir,ROOT_PATH)===0 && stripos($currdir,ROOT_PATH."..")===false){
                    chdir($currdir);
                }
            }
        }
        $rootdir=getcwd();
        $dir=opendir($rootdir);
        $data=[];
        $num=[];
        $num['dir']=0;
        $num['file']=0;
        while ($filename=readdir($dir)){
            if($filename!=="." && $filename!==".."){
                if(is_dir($filename)){
                    $arr['icon']="#icon-wenjianjia1";
                    $arr['flag']=1;
                    $num['dir']++;
                }else{
                    $arr['icon']=$this->seticon($filename);
                    $arr['flag']=0;
                    $num['file']++;
                }
                $arr['currdir']=getcwd()."\\".$filename;
                $arr['name']=$filename;
                $arr['size']=filesize($filename);
                $arr['ctime']=filectime($filename);
                $arr['mtime']=filemtime($filename);
                $data[]=$arr;
            }
        }
        array_multisort(array_column($data,'flag'),SORT_DESC,$data);
        $currpage=$this->page_array($data,5,input('page'));
        $curr=input('page');

        $this->assign([
           'curdir'=>$rootdir,
            'dirs'=>$currpage['data'],
            'page'=>$currpage['page'],
            'num'=>$num
        ]);
        return view('file_index');
    }
    private function seticon($filename){
        $exc=strtoupper(substr($filename,strrpos($filename,".")));
        $icon='';
        switch ($exc){
            case ".HTML":
                $icon="#icon-html1";
                break;
            case ".PHP":
                $icon="#icon-PHP";
                break;
            case ".JS":
                $icon="#icon-JS";
                break;
            case ".BMP":
                $icon="#icon-BMP";
                break;
            case ".PNG":
                $icon="#icon-PNG";
                break;
            case ".JPEG":
                $icon="#icon-JPEG";
                break;
            case ".GIF":
                $icon="#icon-GIF";
                break;
            case ".CSS":
                $icon="#icon-CSS";
                break;
            case ".JPG":
                $icon="#icon-Jpg";
                break;
            case ".JSON":
                $icon="#icon-json_file__ea";
                break;
            default :
                $icon='#icon-file';
        }
        return $icon;
    }

    //数据分页
    protected function page_array($arr,$page=10,$curr)
    {
        $total=ceil(count($arr)/$page);
        if($curr<=0) $curr=1;
        if($curr>$total) $curr=$total;
        $data=array_slice($arr,($curr-1)*$page,$page);
        return [
            'data'=>$data,
            'page'=>[
                'count'=>count($arr),
                'limit'=>$page,
                'curr'=>$curr
            ]
        ];
    }

    //文件删除
    public function del(){
        if(request()->isAjax()){
            $file=iconv('UTF-8','GBK',urldecode(input('file')));
            if(is_dir($file)){
                $arr=scandir($file);

                if(count($arr)===2){
                    @rmdir($file);
                    return json(['msg'=>"目录删除成功"]);
                }else{
                    return json(['msg'=>"目录(不为空)删除失败"]);
                }
            }
            if(is_file($file)){
                @unlink($file);
                return json(['msg'=>"文件删除成功"]);
            }
            return json(['msg'=>"操作异常"]);
        }
    }

    //重命名
    public function renames(){
        if(request()->isAjax()){
            $file=iconv("UTF-8","GB18030",urldecode(input('file')));
            $filename=input('filename');
            $newfile=iconv("UTF-8","GB18030",dirname($file).DS.$filename);
            if(file_exists($newfile)){
                return json(['code'=>0,'msg'=>'文件已存在（重名）']);
            }
            @rename($file,$newfile);
            return json(['code'=>1,'msg'=>'重命名成功']);
        }
    }

    //文件编辑
    public function edit()
    {
        $file=iconv('UTF-8','GB18030',urldecode(input('file')));
        if(empty($file) || !file_exists($file)){
            $this->error("操作异常");
        }
        $arr=['.PHP','.CSS','.JS','.XML','.HTML','.HTACCESS'];
        $exc=strtoupper(substr($file,strrpos($file,".")));
        if(!in_array($exc,$arr)){
            $this->error("该文件类型不支持编辑");
        }
        if(request()->isPost()){
            $content=input('code');
            //打开要编辑的文件
            $fp=fopen($file,'w');
            //写入新内容
            fwrite($fp,$content);//fputs
            //关闭文件
            fclose($fp);
            $this->success("保存成功",'file/index');
        }
        $code=htmlentities(file_get_contents($file),ENT_COMPAT,"UTF-8");
        $this->assign('code',$code);
        $this->assign('currfile',$file);
        $this->assign('ext',$exc);
        return view('file_edit');
    }

    //文件下载
    public function download($currdir=null)
    {
        $file=urldecode($currdir);
        $file=iconv('UTF-8','GB18030',$file);
        if(!file_exists($file)){
            $this->error("文件不存在");
        }
        $filename=basename(iconv('GB18030',"UTF-8",$file));
        header('Content-Disposition: attachment;filename='.$filename);
        readfile($file);
    }
}