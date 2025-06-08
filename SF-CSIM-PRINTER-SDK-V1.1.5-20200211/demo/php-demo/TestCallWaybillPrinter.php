<?php

/**
 * *******2联150 丰密运单*************
 */
/**
 * 调用打印机 不弹出窗口 适用于批量打印【二联单】
 */
$url7 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=noAlertPrint";
/**
 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【二联单】
 */
$url8 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=print";

/**
 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【二联单】
 */
$url9 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=image";

/**
 * *******3联210 丰密运单*************
 */
/**
 * 调用打印机 不弹出窗口 适用于批量打印【三联单】
 */
$url10 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=noAlertPrint";
/**
 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【三联单】
 */
$url11 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=print";

/**
 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【三联单】
 */
$url12 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=image";

echo "---------start\n";
//1.根据业务需求确定请求地址,并确定是否替换版本
$reqURL = handle_url($url12,false);//true 不需要  false 需要

//2.组装参数  丰密参数 true设置 false 不设置
$post_json_data = assembly_param(true);

//3.发送请求
$result = send_post($reqURL, $post_json_data);

//如果url是打印图片 则保存图片到本地
if(strpos($reqURL, "image")){
    //4.处理结果数据
    $imageData = handle_data($result);
    //5图片保存到本地
    save_image($imageData);
}

echo "---------end";

/**
 *保存图片到本地
 * @param unknown $imageData
 */
function save_image($imageData){
    $showtime=date("YmdHis",time()+8*3600);
    //判断是否包含多张图片
    if(strpos($imageData, "\",\"")){
        $var=explode("\",\"",$str);
        $i=0;
        foreach ($var as $value){
            $i++;
            $imgName = "D:\\qiaoWaybill-".$showtime."-".$i.".jpg";
            generate_image($imageData, $imgName);
        }
    }else{
        $imgName = "D:\\qiaoWaybill-".$showtime.".jpg";
        generate_image($imageData, $imgName);
    }
}

/**
 * 处理url
 * @param unknown $reqURL 
 * @param unknown $notTopLogo true 不需要  false 需要
 * @return mixed
 */
function handle_url($reqURL,$notTopLogo){
    
    if ( $notTopLogo && strpos($reqURL, "V2.0"))
    {
        $reqURL = str_replace("V2.0", "V2.1",$reqURL);;
    }
    
    if ($notTopLogo && strpos($reqURL,"V3.0"))
    {
        $reqURL = str_replace("V3.0", "V3.1",$reqURL);
    }
    
    return $reqURL;
}

/**
 * 组装参数
 * @param unknown $fengmi
 * @return string
 */
function assembly_param($fengmi){
    
    
    $waybillDto = new WaybillDto();
    
    //这个必填
    $waybillDto->appId = "SLKJ2019"; //对应丰桥平台获取的clientCode
    $waybillDto->appKey = "FBIqMkZjzxbsZgo7jTpeq7PD8CVzLT4Q"; //对应丰桥平台获取的checkWord
    
    $waybillDto->mailNo = "SF7551234567890";
    //$waybillDto->mailNo="SF7551234567890,SF2000601520988,SF2000601520997";//子母单方式 


    //签回单号  签单返回服务POD 会打印两份快单 其中第二份作为返寄的单==如有签回单业务需要传此字段值
    //$waybillDto->returnTrackingNo="SF1060081717189";	
    
    //收件人信息
    $waybillDto->consignerProvince = "广东省";
    $waybillDto->consignerCity = "深圳市";
    $waybillDto->consignerCounty = "南山区";
    $waybillDto->consignerAddress = "学府路软件产业基地2B12楼5200708号"; //详细地址建议最多30个字  字段过长影响打印效果
    $waybillDto->consignerCompany = "神一样的科技";
    $waybillDto->consignerMobile = "15893799999";
    $waybillDto->consignerName = "风一样的旭哥";
    $waybillDto->consignerShipperCode = "518052";
    $waybillDto->consignerTel = "0755-33123456";
    
    
    //寄件人信息
    $waybillDto->deliverProvince = "浙江省";
    $waybillDto->deliverCity = "杭州市";
    $waybillDto->deliverCounty = "拱墅区";
    $waybillDto->deliverCompany = "神罗科技集团有限公司";
    $waybillDto->deliverAddress = "舟山东路708号古墩路北（玉泉花园旁）百花苑西区7-2-201室"; //详细地址建议最多30个字  字段过长影响打印效果
    $waybillDto->deliverName = "艾丽斯";
    $waybillDto->deliverMobile = "15881234567";
    $waybillDto->deliverShipperCode = "310000";
    $waybillDto->deliverTel = "0571-26508888";
    
    
    $waybillDto->destCode = "755"; //目的地代码 参考顺丰地区编号
    $waybillDto->zipCode = "571"; //原寄地代码 参考顺丰地区编号
    

    
    //1 ：标准快递   2.顺丰特惠   3： 电商特惠   5：顺丰次晨  6：顺丰即日  7.电商速配   15：生鲜速配
    $waybillDto->expressType = 1;
    
    ///addedService
    //   COD代收货款价值 单位元   此项和月结卡号绑定的增值服务相关
    $waybillDto->codValue = "999.9";
    //$waybillDto->codMonthAccount = ""; //代收货款卡号 -如有代收货款专用卡号必传
    
    $waybillDto->insureValue = "501"; //声明保价价值  单位元
    
    $waybillDto->monthAccount = "7550385912"; //月结卡号
    $waybillDto->orderNo = "";
    $waybillDto->payMethod = 1; // 1寄方付 2收方付 3第三方月结支付
    
    $waybillDto->childRemark = "";//子单号备注
    $waybillDto->mainRemark = "";//主运单备注
    $waybillDto->returnTrackingRemark = "";//签回单备注
    //$waybillDto->custLogo = "";
    //$waybillDto->logo = "";
    //$waybillDto->insureFee = "";
    //$waybillDto->payArea = "";
    //加密项
    $waybillDto->encryptCustName = true;//加密寄件人及收件人名称
    $waybillDto->encryptMobile = true;//加密寄件人及收件人联系手机
    
    
    
    $cargo = new CargoInfoDto();
    $cargo->cargo = "苹果7S";
    $cargo->cargoCount = 2;
    $cargo->cargoUnit = "件";
    $cargo->sku = "00015645";
    $cargo->remark = "手机贵重物品 小心轻放";
    
    $cargo2 = new CargoInfoDto();
    $cargo2->cargo = "苹果macbook pro";
    $cargo2->cargoCount = 10;
    $cargo2->cargoUnit = "件";
    $cargo2->sku = "00015646";
    $cargo2->remark = "笔记本贵重物品 小心轻放";
    
    $cargoInfoList = array($cargo,$cargo2);

    
    $waybillDto->cargoInfoDtoList = $cargoInfoList;
    //$waybillDto->rlsInfoDtoList = $rlsInfoDtoList;
    
    
    if ($fengmi)
    {
        $rlsMain = new RlsInfoDto();
        $rlsMain->abFlag = "A";
        $rlsMain->codingMapping = "F33";
        $rlsMain->codingMappingOut = "1A";
        $rlsMain->destRouteLabel = "755WE-571A3";
        $rlsMain->destTeamCode = "012345678";
        $rlsMain->printIcon = "11110000";
        $rlsMain->proCode = "T4";
        $rlsMain->qrcode = "MMM={'k1':'755WE','k2':'021WT','k3':'','k4':'T4','k5':'SF7551234567890','k6':''}";
        $rlsMain->sourceTransferCode = "021WTF";
        $rlsMain->waybillNo = "SF7551234567890";
        $rlsMain->xbFlag = "XB";
        
        $rlsInfoDtoList=array($rlsMain);
        
        if (null != ($waybillDto->returnTrackingNo))
        {
            $rlsBack = new RlsInfoDto();
            $rlsBack->waybillNo = $waybillDto->returnTrackingNo;
            $rlsBack->destRouteLabel = "021WTF";
            $rlsBack->printIcon = "11110000";
            $rlsBack->proCode = "T4";
            $rlsBack->abFlag = "A";
            $rlsBack->xbFlag = "XB";
            $rlsBack->codingMapping = "1A";
            $rlsBack->codingMappingOut = "F33";
            $rlsBack->destTeamCode = "87654321";
            $rlsBack->sourceTransferCode = "755WE-571A3";
            //对应下订单设置路由标签返回字段twoDimensionCode 该参
            $rlsBack->qrcode = "MMM={'k1':'21WT','k2':'755WE','k3':'','k4':'T4','k5':'SF1060081717189','k6':''}";
            
            array_push($rlsInfoDtoList,$rlsBack);
        }
        
        $waybillDto->rlsInfoDtoList = $rlsInfoDtoList;
        
    }
      
    $waybillDtoList = array($waybillDto);
    $post_json_data = json_encode($waybillDtoList,JSON_UNESCAPED_UNICODE);
    return  $post_json_data;
}


/**
 * 发送post请求
 *
 * @param string $url
 *            请求地址
 * @param array $post_data
 *            post键值对数据
 * @return string
 */
function send_post($reqURL, $post_data)
{
    
    echo "url:" .$reqURL;
    echo "\n";
    echo "参数:" .$post_data;
    //curl验证成功
    $ch = curl_init($reqURL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($post_data)
    ));
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        print curl_error($ch);
    }
    curl_close($ch);
   
    if(strpos($reqURL, "image")=== false){
        echo "\n";
        echo "返回:".$result;
    }
    return $result;
}

/**
 * 处理数据
 * @param unknown $result
 */
function handle_data($result){
    
    $startIndex = strpos($result,"[")+1;
    $substrLen = strrpos($result,"]") - $startIndex;
    
    print_r('_______________________________________');
    
    print_r($result);
    
    print_r('======================================');
    
    print_r($startIndex);
    
    print_r('+++++++++++++++++++++++++++++++++++++++');
    
    print_r($substrLen);die;
    
    $imageData = substr($result,$startIndex,$substrLen);
    
    /**
     * 如果以 \ 开头 ,截取
     */
    if(strpos($imageData,"\\")===0){
        $imageData = substr($imageData,1);
    }
    
    /**
     * 如果以 \ 结尾 ,截取
     */
    if(substr_compare($imageData, "\\", -strlen("\\")) === 0){
        $imageData = substr($imageData,0,(strlen($imageData)-1));
    }
    
    //换行符替换为空
    str_replace("\\n", "",$imageData);
    return $imageData;
}

/**
 * 
 * @param unknown $imgStr 图片文件内容
 * @param unknown $imgName 图片地址+名称
 * @return boolean
 */
function generate_image($imgStr, $imgName){
    if ($imgStr == null){
        return false;
    }
    
    $r = file_put_contents($imgName, base64_decode($imgStr));
    
    echo "\n";
    if (!$r) {
        echo $imgName." 图片生成失败\n";
    }else{
        echo $imgName." 图片生成成功\n";
    }
}


class CargoInfoDto
{    
    var $cargo;    
    var $parcelQuantity;    
    var $cargoCount;    
    var $cargoUnit;    
    var $cargoWeight;    
    var $cargoAmount;    
    var $cargoTotalWeight;
    var $remark;    
    var $sku;
}

class RlsInfoDto
{
    public $abFlag;
    public $codingMapping;
    public $codingMappingOut;
    public $destRouteLabel;
    public $destTeamCode;
    public $printIcon;
    public $proCode;
    public $qrcode;
    public $sourceTransferCode;
    public $waybillNo;
    public $xbFlag;
}
class WaybillDto
{    
    public $mailNo;
    public $expressType;
    public $payMethod;
    public $returnTrackingNo;
    public $monthAccount;
    public $orderNo;
    public $zipCode;
    public $destCode;
    public $payArea;
    public $deliverCompany;
    public $deliverName;
    public $deliverMobile;
    public $deliverTel;
    public $deliverProvince;
    public $deliverCity;
    public $deliverCounty;
    public $deliverAddress;
    public $deliverShipperCode;
    public $consignerCompany;
    public $consignerName;
    public $consignerMobile;
    public $consignerTel;
    public $consignerProvince;
    public $consignerCity;
    public $consignerCounty;
    public $consignerAddress;
    public $consignerShipperCode;
    public $logo;
    public $sftelLogo;
    public $topLogo;
    public $topsftelLogo;
    public $appId;
    public $appKey;
    public $electric;
    public $cargoInfoDtoList;
    public $rlsInfoDtoList;
    public $insureValue;
    public $codValue;
    public $codMonthAccount;
    
    
    public $mainRemark;
    public $returnTrackingRemark;
    public $childRemark;
    public $custLogo;
    public $insureFee;
    
    public $encryptCustName; //加密寄件人及收件人名称
    public $encryptMobile; //加密寄件人及收件人联系手机
}


?>