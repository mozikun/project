<?php

/*
 * 居民核心表的比对
 */

class cmp_cmpController
{
    /*
     * 找出公安局有的数据但是雅安系统没有的数据，并写入数据库
     */

    public function indexAction()
    {

        // echo strtolower("adfdsfdfdfABC1234442333");exit();
        // echo 100%110;exit();
        require_once __SITEROOT . "library/Models/individual_core.php"; //
        $head = array();
        $head[0] = '姓名';
        $head[1] = '身份证号码';
        $head[2] = '性别';
        $head[3] = '民族';
        $head[4] = '';
        $head[5] = '县区码';
        $head[6] = '村组码';
        $head[7] = '地址';
        $sex=array(1=>'男',2=>'女');
        $file = fopen("e:/hjxx.csv", "a+");
        $file_meiyou = fopen("e:/data/new/gongan_1.csv", "a+");
        //写入头部信息
        fputcsv($file_meiyou, $head);
        $core = new Tindividual_core();
        $i = 0;
        $j = 1;
        while (!feof($file))
        {
            $arr = fgetcsv($file);
            if($arr[6]=='513122001077'){
            $core->whereAdd("identity_number='{$arr[1]}'or identity_number='" . strtolower($arr[1]) . "'");
            //$core->whereAdd($where)
            //如果这条记录不存在
            if ($core->count() < 1)
            {
                //给纯数字加上引号，防止在excel中打开默认用科学计数显示
                $arr[1] = '\'' . $arr[1] . '\'';
                $arr[6] = '\'' . $arr[6] . '\'';
                $arr[2]=$sex[$arr[2]];
                $arr[3]='汉';
                //将这条记录写入csv文件   
                if (fputcsv($file_meiyou, $arr))
                {
                    $i++;
                }

                if ($i % 10000 == 0)
                {
                    echo"完成{$j}个文件<br/>";
                    $j++;
                    fclose($file_meiyou);
                    $file_meiyou = fopen("e:/data/new/gongan_{$j}.csv", "a+");
                    fputcsv($file_meiyou, $head);
                }
            }
            }
        }
        echo "程序执行完成";
        fclose($file);
        fclose($file_meiyou);
    }

    /*
     * 找出公安局于雅安系统身份证相同但姓名不同的数据并写入数据库
     */

    public function cmpAction()
    {
        require_once __SITE_ROOT . "library/Models/individual_core.php"; //
        // require_once __SITE_ROOT . "library/Models/butong.php"; //
        $file = fopen("e:/datas/hjxx_butong.csv", "a+"); //打开公安局数据文件
        $file_butong = fopen("e:/butong/butong_1.csv", "a+");   //结果文件
        $core = new Tcore();
        /*

          for($x=1;$x<=1332980;$x++){
          fgetcsv($file);
          }

         * 
         */
        $i = 1; //用于写入文件的数据数目计数
        $j = 1; //文件个数的计数，每个文件20万条记录
        while (!feof($file))
        {
            $arr = fgetcsv($file);
            // print_r($arr); fclose($file);exit();
            $core->where("id='{$arr[1]}' or id='" . strtolower($arr[1]) . "' ");
            if ($core->count() > 0)
            {  //如果记录存在
                $core->find(true);
                if ($core->name != $arr[0])
                {   //身份证相同姓名不同
                    $arr[9] = "--------";
                    $arr[10] = $core->name;
                    $arr[11] = $core->id;
                    $arr[12] = $core->address;
                    if (fputcsv($file_butong, $arr))
                    {  //写入文件保存记录
                        $i++;                    //记录数自加
                    }
                    if ($i % 100000 == 0)
                    {       //记录条数超过10万
                        $j++;
                        fclose($file_butong);    //关闭现在打开的文件
                        $file_butong = fopen("e:/datas/butong/butong_{$j}.csv", "a+");   //新建文件
                    }
                }
            }
        }
        echo "ok";
        fclose($file);
        fclose($file_butong);
    }

    public function testAction()
    {
        // echo 100%110;exit();

        require_once __SITEROOT . "library/Models/hjxx.php"; //
        $file = fopen("e:/duoyu.csv", "a+");
        $file_meiyou = fopen("e:/duo/meiyou_1.csv", "a+");
        // $meiyou = new Tmeiyou();
        $core = new Tindividual_core();
        $i = 1;
        $j = 1;
        while (!feof($file))
        {
            $arr = fgetcsv($file);
            $core->where("identity_number='{$arr[1]}'");
            if ($core->count() < 1)
            {
                if (fputcsv($file_meiyou, $arr))
                {
                    $i++;
                }
                if ($i % 200000 == 0)
                {
                    $j++;
                    fclose($file_meiyou);
                    $file_meiyou = fopen("e:/meiyou/meiyou_{$j}.csv", "a+");
                }
            }
        }
        echo "ok";
        fclose($file);
        fclose($file_meiyou);
    }

    /*     * ****************************
     * 雅安系统中存在公安系统不存在的信息
     * **************************** */

    public function duoyuAction()
    {

        require_once __SITEROOT . "library/Models/INDIVIDUAL_CORE.php";
        require_once __SITEROOT . "library/Models/HJXX_CZRKJBXXB.php";
        require_once __SITEROOT . "library/Models/region.php";

        $head['name'] = '姓名';
        $head['sex'] = '性别';
        $head['id'] = '身份证号';
        $head['address'] = '地址';
        $file = fopen("e:/core.csv", "a+");
        $file_duoyu = fopen("e:/data/yaan/yaan_1.csv", "a+");
        fputcsv($file_duoyu, $head);
        fgetcsv($file);
        //$core = new Tindividual_core();
        $hjxx = new Thjxx_czrkjbxxb();
       
        $i = 0;
        $j = 1;
  
        while (!feof($file))
            
        {  
            $arr= fgetcsv($file);
            if (!empty($arr[2]))
            { 
                $hjxx->where("gmsfhm='" . strtoupper($arr[2]) . "'");
                if ($hjxx->count() < 1)
                {      
                   // $paths = substr($arr[3], 8);  echo $paths;exit();
                  //  $path = explode(",", $paths); //将region_path打撒成数组
                   $str_path = '0,1,2,5'; //初始region_path
                    $str_address = '';
                    //寻找地址        
                   
                    for ($index=7;$index<count($arr);$index++)
                    { 
			$region = new Tregion();
                        $str_path.=',' . $arr[$index];   
                        $region->whereAdd("region_path='{$str_path}'");
                        // $region->debug(1);
                        $region->find(true); 
                        $str_address.=$region->zh_name;
                      //  echo $str_address;exit();
			
                        
                    }  
                    $info=array();
                    $info['name'] = $arr[0];
                    $info['sex'] = $arr[1];
                    $info['id'] = '\'' . $arr[2]. '\'';
                    $info['address'] = $str_address;
                    

                    if (fputcsv($file_duoyu, $info))
                    {
                        $i++;
                    }
                    //释放内存
                   // unset($arr);
                    if ($i % 20000 == 0)
                    {
                        //echo"完成一个文件<br/>";
                        $j++;
                        fclose($file_duoyu);
                        $file_duoyu = fopen("e:/data/yaan/yaan_{$j}.csv", "a+");
                        fputcsv($file_duoyu, $head);
                    }
                }
		
            }

        }
       

        echo "ok";
        fclose($file);
        fclose($file_duoyu);
    }

    public function file_testAction()
    {
        $lines = file("e:/hjxx.csv");

        echo count($lines);
    }

}

?>