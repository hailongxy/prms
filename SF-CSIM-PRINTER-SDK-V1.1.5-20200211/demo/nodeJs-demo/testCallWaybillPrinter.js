'use strict'

const request = require('request');
const fs = require('fs')

/*********2联150 丰密运单**************/
/**
 * 调用打印机 不弹出窗口 适用于批量打印【二联单】
 */
const url7 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=noAlertPrint";
/**
 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【二联单】
 */
const url8 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=print";

/**
 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【二联单】
 */
const url9 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=image";


/*********3联210 丰密运单**************/
/**
 * 调用打印机 不弹出窗口 适用于批量打印【三联单】
 */
const url10 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=noAlertPrint";
/**
 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【三联单】
 */
const url11 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=print";

/**
 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【三联单】
 */
const url12 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=image";

//根据业务需求确定请求地址
let reqURL = url12;

//电子面单顶部是否需要logo 
let topLogo = true; //true 需要logo  false 不需要logo
if (reqURL.indexOf("V2.0") !== -1 && topLogo) {
    reqURL = reqURL.replace(/V2.0/ig, "V2.1");
}

if (reqURL.indexOf("V3.0") !== -1 && topLogo) {
    reqURL = reqURL.replace(/V3.0/ig, "V3.1");
}

/** 
 * 其中127.0.0.1:4040为打印服务部署的地址（端口如未指定，默认为4040）
 * type为模板类型（支持两联、三联，尺寸为100mm*150mm和100mm*210mm，type为poster_100mm150mm和poster_100mm210mm）
 * A5 poster_100mm150mm   A5 poster_100mm210mm
 * output为输出类型,值为print或image，如不传
 * 默认为print（print 表示直接打印，image表示获取图片的BASE64编码字符串）
 * V2.0/V3.0模板顶部是带logo的  V2.1/V3.1顶部不带logo
 * 若有签回单号，则需配置签回单丰密相关配置，即参数rlsInfoDtoList[1]
 */
console.log('请求地址：' + reqURL);


let data = {
    //基本信息
    mailNo: null, //请使用国家统一运单号15位
    mainRemark:null,//主运单备注信息
    childRemark:null,//子运单备注信息
    expressType: 1,
    payMethod: 1,
    returnTrackingNo: null,//签回单号
    returnTrackingRemark: null,//签回单备注信息
    monthAccount: null,
    orderNo: null,
    zipCode: null,
    destCode: null,
    payArea: null,
    //寄件人信息
    deliverCompany: null,
    deliverName: null,
    deliverMobile: null,
    deliverTel: null,
    deliverProvince: null,
    deliverCity: null,
    deliverCounty: null,
    deliverAddress: null,
    deliverShipperCode: null,
    //收件人信息
    consignerCompany: null,
    consignerName: null,
    consignerMobile: null,
    consignerTel: null,
    consignerProvince: null,
    consignerCity: null,
    consignerCounty: null,
    consignerAddress: null,
    consignerShipperCode: null,
    //logo相关
    logo: null,
    sftelLogo: null,
    topLogo: null,
    topsftelLogo: null,
    //其他信息
    totalFee: null,
    appId: null,
    appKey: null,
    electric: null,
    insureValue: null,
    insureFee: null,
    codValue: null,
    codMonthAccount: null,
    //丰密运单相关配置
    // abFlag: null,
    // xbFlag: null,
    // proCode: null,
    // destRouteLabel: null,
    // destTeamCode: null,
    // codingMapping: null,
    // codingMappingOut: null,
    // sourceTransferCode: null,
    // printIcon: null,
    // qrcode: null,
    //丰密运单相关配置
    rlsInfoDtoList: [{
        waybillNo: null,
        abFlag: null,
        xbFlag: null,
        proCode: null,
        destRouteLabel: null,
        destTeamCode: null,
        codingMapping: null,
        codingMappingOut: null,
        sourceTransferCode: null,
        printIcon: null,
        qrcode: null
    }],
    //加密
    encryptMobile: false,
    encryptCustName: false,
    //货物信息
    cargoInfoDtoList: [{
            cargo: null,
            parcelQuantity: null,
            cargoCount: null,
            cargoUnit: null,
            cargoWeight: null,
            cargoAmount: null,
            cargoTotalWeight: null,
            remark: null,
            sku: null
        },
        {
            cargo: null,
            parcelQuantity: null,
            cargoCount: null,
            cargoUnit: null,
            cargoWeight: null,
            cargoAmount: null,
            cargoTotalWeight: null,
            remark: null,
            sku: null
        }
    ]
};
/**
 *   这个必填 
 *   data.AppId;     //对应clientCode
 *   data.AppKey;    //对应checkWord
 */
data.appId = ''; 
data.appKey = ''; 

/** 
 * 子母单方式
 * data.mailNo = 'SF7551234567890,SF0010000000002';//请使用国家统一运单号15位
 */
data.mailNo = 'SF7551234567890';//请使用国家统一运单号15位

/** 
 * 收件人信息 
 */
data.consignerProvince = '广东省';
data.consignerCity = '深圳市';
data.consignerCounty = '南山区';
data.consignerAddress = '学府路软件产业基地2B12楼5200708号'; //详细地址建议最多30个字, 字段过长影响打印效果
data.consignerCompany = '神一样的科技';
data.consignerMobile = '15893799999';
data.consignerName = '风一样的旭哥';
data.consignerShipperCode = '518052';
data.consignerTel = '0755-33123456';

/** 
 * 寄件人信息 
 */
data.deliverProvince = '浙江省';
data.deliverCity = '杭州市';
data.deliverCounty = '拱墅区';
data.deliverCompany = '神罗科技集团有限公司';
data.deliverAddress = '舟山东路708号古墩路北（玉泉花园旁）百花苑西区7-2-201室';
data.deliverName = '艾丽斯';
data.deliverMobile = '15881234567';
data.deliverShipperCode = '310000';
data.deliverTel = '0571-26508888';

data.destCode = '755'; //目的地代码 参考顺丰地区编号
data.zipCode = '571'; //原寄地代码 参考顺丰地区编号

/** 
 * 签回单号  签单返回服务 会打印两份快单 其中第二份作为返寄的单
 * 如客户使用签单返还业务则需打印“POD”字段，用以提醒收派员此件为签单返还快件
 */


/** 
 * 快递类型
 * 1 ：标准快递   2.顺丰特惠   3： 电商特惠   5：顺丰次晨  6：顺丰即日  7.电商速配   15：生鲜速配
 */
data.expressType = 2;


/** 
 * 增值服务选项
 */
data.codMonthAccount = '7550385913'; //COD代收货款月结卡号，可以跟月结卡号同值
data.codValue = '999.9'; //COD代收货款金额,只需填金额, 单位元- 此项和月结卡号绑定的增值服务相关
data.insureValue = '501'; //声明货物价值的保价金额,只需填金额,单位元
data.monthAccount = '7550385912'; //月结卡号  
data.payMethod = 1; // 1-寄付 2-到付 3-第三方支付


/**
 * 主运单丰密相关配置
 */
data.rlsInfoDtoList[0].destRouteLabel = '755WE-571A3';
data.rlsInfoDtoList[0].printIcon = '1111';
data.rlsInfoDtoList[0].proCode = 'T6';
data.rlsInfoDtoList[0].abFlag = 'A';
data.rlsInfoDtoList[0].xbFlag = 'XB';
data.rlsInfoDtoList[0].codingMapping = 'F33';
data.rlsInfoDtoList[0].codingMappingOut = '1A';
data.rlsInfoDtoList[0].destTeamCode = '012345678';
data.rlsInfoDtoList[0].sourceTransferCode = '021WTF';
data.rlsInfoDtoList[0].qrcode = "MMM={'k1':'755WE','k2':'755BF','k3':'','k4':'T6','k5':'SF7551234567890','k6':'A'}"; //对应下订单设置路由标签返回字段twoDimensionCode 该参数是丰密面单的二维码图

/**
 * 有签回单号时，签回单丰密相关配置（如无签回单，请注释下面相关代码）
 */
data.returnTrackingNo='SF1060081717189'; // 签回单号请-----使用国家统一运单号15位
data.rlsInfoDtoList.push({
    abFlag: 'A',
    xbFlag: 'XB',
    proCode: 'T6',
    destRouteLabel:  '021WTF',
    destTeamCode: '87654321',
    codingMapping: '1A',
    codingMappingOut: 'F33',
    sourceTransferCode: '755WE-571A3',
    printIcon: '11',
    qrcode: "MMM={'k1':'21WT','k2':'755WE','k3':'','k4':'T4','k5':'SF1060081717189','k6':''}"
});

/** 
 * 加密项
 */
data.encryptCustName = true; //加密寄件人及收件人名称
data.encryptMobile = true; //加密寄件人及收件人联系手机

/** 
 * 货物信息
 */
data.cargoInfoDtoList[0].cargo = '苹果macbook pro';
data.cargoInfoDtoList[0].cargoCount = 1;
data.cargoInfoDtoList[0].cargoUnit = '件';
data.cargoInfoDtoList[0].sku = '00015646';
data.cargoInfoDtoList[0].remark = '笔记本贵重物品 小心轻放';
data.cargoInfoDtoList[1].cargo = '苹果7S';
data.cargoInfoDtoList[1].cargoCount = 1;
data.cargoInfoDtoList[1].cargoUnit = '件';
data.cargoInfoDtoList[1].sku = '00015645';
data.cargoInfoDtoList[1].remark = '手机贵重物品 小心轻放';

console.log('请求参数：' + JSON.stringify(data))


let options = {
    body: "[" + JSON.stringify(data) + "]"
};
request.post(reqURL, options, function (error, response, body) {
    if (error) {
        console.log("--------------------------------------");
        console.error(`请求遇到问题: ${error}`);
        console.log("--------------------------------------");
    }
    if (body) {
        if (reqURL.indexOf("output=print") !== -1 || reqURL.indexOf("output=noAlertPrint") !== -1) { //打印机输出
            console.log("--------------------------------------");
            console.log("返回报文: " + body);
        } else { //打印图片输出
            console.log("--------------------------------------");
            var imgBase64StrArr = JSON.parse(body).result; //json字符串转为json对象
            if (imgBase64StrArr instanceof Array) {
                for (let i = 0; i <= imgBase64StrArr.length - 1; i++) {
                    let path = 'D:\\qiaoWay' + Date.now() + '.jpeg'; //将图片存储到D盘根目录下
                    let imgBase64StrBuffer = new Buffer(imgBase64StrArr[i], 'base64'); //把base64码转成buffer对象
                    fs.writeFile(path, imgBase64StrBuffer, function (err) { //用fs写入文件
                        if (err) {
                            console.log(err);
                        } else {
                            console.log('图片：第' + (i + 1) + '张 / 共' + imgBase64StrArr.length + '张 存储到【D:/】成功');
                            console.log("--------------------------------------");
                        }
                    });
                }
            }else{
                console.log("返回报文: " + body);
                console.log("--------------------------------------");
            }
        }

    }
})