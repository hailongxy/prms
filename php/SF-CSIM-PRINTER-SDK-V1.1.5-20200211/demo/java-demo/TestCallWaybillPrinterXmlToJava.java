package com.sf.test;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.StringWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.Iterator;
import java.util.List;

import org.apache.commons.lang.StringUtils;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.sf.dto.CargoInfoDto;
import com.sf.dto.RlsInfoDto;
import com.sf.dto.WaybillDto;
import com.sf.dto.xmlToJava.AddedServiceRequest;
import com.sf.dto.xmlToJava.CargoRequest;
import com.sf.dto.xmlToJava.OrderRequest;
import com.sf.dto.xmlToJava.OrderResponse;
import com.sf.dto.xmlToJava.RequestXmlDto;
import com.sf.dto.xmlToJava.ResponseXmlDto;
import com.sf.dto.xmlToJava.RlsDetailResponse;
import com.sf.dto.xmlToJava.RlsInfoResponse;
import com.sf.util.Base64ImageTools;
import com.sf.util.MyJsonUtil;
import com.sf.util.PrintUtil;
import com.sf.util.XmlToJavaBeanUtil;

public class TestCallWaybillPrinterXmlToJava {
	
	/**此测试类供通过下订单的接口的请求及返回XML报文直接转化为运单SDK调用必须参数**/

	public static void main(String[] args) throws Exception {
		String reqPathName = "D:\\TXT\\CESHIrequest.txt";
		String resPathName = "D:\\TXT\\CESHIresponse.txt";
		String xmlReq = "";
		String xmlRes = "";
		TestCallWaybillPrinterXmlToJava.WayBillPrinterTools(reqPathName, resPathName, xmlReq, xmlRes);

	}

	public static void WayBillPrinterTools(String reqPathname, String resPathname, String xmlReq, String xmlRes)
			throws Exception {

		

		/********* 2联150 丰密运单 **************/
		/**
		 * 调用打印机 不弹出窗口 适用于批量打印【二联单】
		 */
		String url7 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=noAlertPrint";
		/**
		 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【二联单】
		 */
		String url8 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=print";

		/**
		 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【二联单】
		 */
		String url9 = "http://localhost:4040/sf/waybill/print?type=V2.0.FM_poster_100mm150mm&output=image";

		/********* 3联210 丰密运单 **************/
		/**
		 * 调用打印机 不弹出窗口 适用于批量打印【三联单】
		 */
		String url10 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=noAlertPrint";
		/**
		 * 调用打印机 弹出窗口 可选择份数 适用于单张打印【三联单】
		 */
		String url11 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=print";

		/**
		 * 直接输出图片的BASE64编码字符串 可以使用html标签直接转换成图片【三联单】
		 */
		String url12 = "http://localhost:4040/sf/waybill/print?type=V3.0.FM_poster_100mm210mm&output=image";

		// 根据业务需求确定请求地址
		String reqURL = url9;

		// 电子面单顶部是否需要logo
		boolean topLogo = true;// true 需要logo false 不需要logo
		if (reqURL.contains("V2.0") && topLogo) {
			reqURL = reqURL.replace("V2.0", "V2.1");
		}

		if (reqURL.contains("V3.0") && topLogo) {
			reqURL = reqURL.replace("V3.0", "V3.1");
		}

		System.out.println(reqURL);

		/** 注意 需要使用对应业务场景的url **/
		URL myURL = new URL(reqURL);

		// 其中127.0.0.1:4040为打印服务部署的地址（端口如未指定，默认为4040），
		// type为模板类型（支持两联、三联，尺寸为100mm*150mm和100mm*210mm，type为poster_100mm150mm和poster_100mm210mm）
		// A5 poster_100mm150mm A5 poster_100mm210mm
		// output为输出类型,值为print或image，如不传，
		// 默认为print（print 表示直接打印，image表示获取图片的BASE64编码字符串）
		// V2.0/V3.0模板顶部是带logo的 V2.1/V3.1顶部不带logo

		HttpURLConnection httpConn = (HttpURLConnection) myURL.openConnection();
		httpConn.setDoOutput(true);
		httpConn.setDoInput(true);
		httpConn.setUseCaches(false);
		httpConn.setRequestMethod("POST");
		// httpConn.setRequestProperty("Content-Type",
		// "application/json;charset=utf-8");
		httpConn.setRequestProperty("Content-Type", "text/plain;charset=utf-8");

		httpConn.setConnectTimeout(5000);
		httpConn.setReadTimeout(3 * 5000);

		// 获取xml转java请求报文对象
		RequestXmlDto req = (RequestXmlDto) XmlToJavaBeanUtil.xmlToJavaBean(reqPathname, RequestXmlDto.class, xmlReq);
		// 获取order标签对象
		OrderRequest orderRequest = req.getBody().getOrder();
		// 获取AddedService标签对象
		AddedServiceRequest addedServiceRequest = orderRequest.getAddedServiceRequest();
		// 获取cargo标签对象
		List<CargoRequest> cargoList = orderRequest.getCargoList();

		// 获取xml转java返回报文对象
		ResponseXmlDto res = (ResponseXmlDto) XmlToJavaBeanUtil.xmlToJavaBean(resPathname, ResponseXmlDto.class,
				xmlRes);
		// 获取OrderResponse标签对象
		OrderResponse orderResponse = res.getBody().getOrderResponse();
		// 获取RlsInfo标签对象
		List<RlsInfoResponse> rlsInfoList = orderResponse.getRlsInfoResList();

		List<WaybillDto> waybillDtoList = new ArrayList<WaybillDto>();
		WaybillDto dto = new WaybillDto();

		// 这个必填
		dto.setAppId(req.getClientCode());// 对应clientCode
		dto.setAppKey("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");// 对应checkWord

		String mailno = orderResponse.getMailno();// 主运单号
		if (StringUtils.isNotBlank(mailno) && mailno.split(",").length > 1) {
			String[] mailNos = mailno.split(",");
			StringBuilder sb = new StringBuilder();
			for (String s : mailNos) {
				sb.append(s);
				sb.append(",");
			}
			int num = sb.lastIndexOf(",");
			String newStr = sb.substring(0, num);
			dto.setMailNo(newStr);// 子母单方式
		} else if (StringUtils.isNotBlank(mailno)) {
			dto.setMailNo(mailno);
		}
		// 签回单号 签单返回服务 会打印两份快单 其中第二份作为返寄的单
		dto.setReturnTrackingNo(orderResponse.getReturn_tracking_no());
		// 收件人信息
		dto.setConsignerProvince(orderRequest.getConsignerProvince());
		dto.setConsignerCity(orderRequest.getConsignerCity());
		dto.setConsignerCounty(orderRequest.getConsignerCounty());
		dto.setConsignerAddress(orderRequest.getConsignerAddress()); // 详细地址建议最多30个字
		// 字段过长影响打印效果
		dto.setConsignerCompany(orderRequest.getConsignerCompany());
		dto.setConsignerName(orderRequest.getConsignerName());
		dto.setConsignerShipperCode(orderRequest.getConsignerShipperCode());
		if(StringUtils.isBlank(orderRequest.getConsignerMobile()) && StringUtils.isNotBlank(orderRequest.getConsignerTel())){
			dto.setConsignerMobile(orderRequest.getConsignerTel());
		}else if(StringUtils.isNotBlank(orderRequest.getConsignerMobile()) && StringUtils.isBlank(orderRequest.getConsignerTel())){
			dto.setConsignerMobile(orderRequest.getConsignerMobile());
		}else if(StringUtils.isNotBlank(orderRequest.getConsignerMobile()) && StringUtils.isNotBlank(orderRequest.getConsignerTel())){
			dto.setConsignerMobile(orderRequest.getConsignerMobile());
			dto.setConsignerTel(orderRequest.getConsignerTel());
		}
		
		// 寄件人信息
		dto.setDeliverProvince(orderRequest.getDeliverProvince());
		dto.setDeliverCity(orderRequest.getDeliverCity());
		dto.setDeliverCounty(orderRequest.getDeliverCounty());
		dto.setDeliverCompany(orderRequest.getDeliverCompany());
		dto.setDeliverAddress(orderRequest.getDeliverAddress());// 详细地址建议最多30个字
																// 字段过长影响打印效果
		dto.setDeliverName(orderRequest.getDeliverName());
		if(StringUtils.isBlank(orderRequest.getDeliverMobile()) && StringUtils.isNotBlank(orderRequest.getDeliverTel())){
			dto.setDeliverMobile(orderRequest.getDeliverTel());
		}else if(StringUtils.isNotBlank(orderRequest.getDeliverMobile()) && StringUtils.isBlank(orderRequest.getDeliverTel())){
			dto.setDeliverMobile(orderRequest.getDeliverMobile());
		}else if(StringUtils.isNotBlank(orderRequest.getDeliverMobile()) && StringUtils.isNotBlank(orderRequest.getDeliverTel())){
			dto.setDeliverMobile(orderRequest.getDeliverMobile());
			dto.setDeliverTel(orderRequest.getDeliverTel());
		}
		dto.setDeliverShipperCode(orderRequest.getDeliverShipperCode());

		dto.setDestCode(orderRequest.getDestCode());// 目的地代码 参考顺丰地区编号
		dto.setZipCode(orderRequest.getZipCode());// 原寄地代码 参考顺丰地区编号
		// 陆运E标示
		// 业务类型为“电商特惠、顺丰特惠、电商专配、陆运件”则必须打印E标识，用以提示中转场分拣为陆运
		dto.setElectric("E");
		// 快递类型
		// 1 ：标准快递 2.顺丰特惠 3： 电商特惠 5：顺丰次晨 6：顺丰即日 7.电商速配 15：生鲜速配
		dto.setExpressType(orderRequest.getExpressType());

		// COD代收货款金额,只需填金额, 单位元- 此项和月结卡号绑定的增值服务相关
		if (addedServiceRequest != null && addedServiceRequest.getName() != null
				&& addedServiceRequest.getName().equals("COD")) {
			dto.setCodValue(addedServiceRequest.getValue());
		} else if (addedServiceRequest != null && addedServiceRequest.getName() != null
				&& addedServiceRequest.getName().equals("INSURE")) {
			dto.setInsureValue(addedServiceRequest.getValue());// 声明货物价值的保价金额,只需填金额,单位元
		}
		dto.setMonthAccount(orderRequest.getMonthAccount());// 月结卡号
		dto.setPayMethod(orderRequest.getPayMethod());//

		// 获取主运单信息
		RlsInfoResponse mainRlsRlsInfo = new RlsInfoResponse();

		Iterator<RlsInfoResponse> it = rlsInfoList.iterator();
		while (it.hasNext()) {
			RlsInfoResponse rlsInfoResponse = it.next();
			String waybillNo = rlsInfoResponse.getRlsDetailRes().getWaybillNo();
			if (StringUtils.isNotBlank(mailno) && mailno.split(",").length > 1) {
				if (mailno.split(",")[0].equals(waybillNo)) {
					mainRlsRlsInfo = rlsInfoResponse;
					it.remove();
				}
			} else if (StringUtils.isNotBlank(mailno)) {
				if (mailno.equals(waybillNo)) {
					mainRlsRlsInfo = rlsInfoResponse;
					it.remove();
				}
			}
		}
		// 获取主丰密运单
		RlsDetailResponse mainRlsDetail = mainRlsRlsInfo.getRlsDetailRes();
		/** 丰密运单相关-如非使用丰密运单模板 不需要设置以下值 **/

		List<RlsInfoDto> rlsInfoDtoList = new ArrayList<RlsInfoDto>();
		RlsInfoDto rlsMain = new RlsInfoDto();
		// 主运单号
		rlsMain.setWaybillNo(mainRlsDetail.getWaybillNo());
		rlsMain.setDestRouteLabel(
				StringUtils.isNotBlank(mainRlsDetail.getDestRouteLabel()) ? mainRlsDetail.getDestRouteLabel() : "");
		rlsMain.setPrintIcon(StringUtils.isNotBlank(mainRlsDetail.getPrintIcon()) ? mainRlsDetail.getPrintIcon() : "");
		rlsMain.setProCode(StringUtils.isNotBlank(mainRlsDetail.getProCode()) ? mainRlsDetail.getProCode() : "");
		rlsMain.setAbFlag(StringUtils.isNotBlank(mainRlsDetail.getAbFlag()) ? mainRlsDetail.getAbFlag() : "");
		rlsMain.setXbFlag(StringUtils.isNotBlank(mainRlsDetail.getXbFlag()) ? mainRlsDetail.getXbFlag() : "");
		rlsMain.setCodingMapping(
				StringUtils.isNotBlank(mainRlsDetail.getCodingMapping()) ? mainRlsDetail.getCodingMapping() : "");
		rlsMain.setCodingMappingOut(
				StringUtils.isNotBlank(mainRlsDetail.getCodingMappingOut()) ? mainRlsDetail.getCodingMappingOut() : "");
		rlsMain.setDestTeamCode(
				StringUtils.isNotBlank(mainRlsDetail.getDestTeamCode()) ? mainRlsDetail.getDestTeamCode() : "");
		rlsMain.setSourceTransferCode(StringUtils.isNotBlank(mainRlsDetail.getSourceTransferCode())
				? mainRlsDetail.getSourceTransferCode() : "");
		// 对应下订单设置路由标签返回字段twoDimensionCode 该参
		rlsMain.setQRCode(StringUtils.isNotBlank(mainRlsDetail.getQRCode()) ? mainRlsDetail.getQRCode() : "");
		rlsInfoDtoList.add(rlsMain);

		// 获取签回单信息
		RlsInfoResponse rlsInfoResReturn = rlsInfoList.get(0);
		RlsDetailResponse rlsDetailReturn = rlsInfoResReturn.getRlsDetailRes();
		if (dto.getReturnTrackingNo() != null) {
			RlsInfoDto rlsBack = new RlsInfoDto();
			// 签回运单号Z
			rlsBack.setWaybillNo(dto.getReturnTrackingNo());
			rlsBack.setDestRouteLabel(StringUtils.isNotBlank(rlsDetailReturn.getDestRouteLabel())
					? rlsDetailReturn.getDestRouteLabel() : "");
			rlsBack.setPrintIcon(
					StringUtils.isNotBlank(rlsDetailReturn.getPrintIcon()) ? rlsDetailReturn.getPrintIcon() : "");
			rlsBack.setProCode(
					StringUtils.isNotBlank(rlsDetailReturn.getProCode()) ? rlsDetailReturn.getProCode() : "");
			rlsBack.setAbFlag(StringUtils.isNotBlank(rlsDetailReturn.getAbFlag()) ? rlsDetailReturn.getAbFlag() : "");
			rlsBack.setXbFlag(StringUtils.isNotBlank(rlsDetailReturn.getXbFlag()) ? rlsDetailReturn.getXbFlag() : "");
			rlsBack.setCodingMapping(StringUtils.isNotBlank(rlsDetailReturn.getCodingMapping())
					? rlsDetailReturn.getCodingMapping() : "");
			rlsBack.setCodingMappingOut(StringUtils.isNotBlank(rlsDetailReturn.getCodingMappingOut())
					? rlsDetailReturn.getCodingMappingOut() : "");
			rlsBack.setDestTeamCode(
					StringUtils.isNotBlank(rlsDetailReturn.getDestTeamCode()) ? rlsDetailReturn.getDestTeamCode() : "");
			rlsBack.setSourceTransferCode(StringUtils.isNotBlank(rlsDetailReturn.getSourceTransferCode())
					? rlsDetailReturn.getSourceTransferCode() : "");
			// 对应下订单设置路由标签返回字段twoDimensionCode 该参
			rlsBack.setQRCode(rlsDetailReturn.getQRCode());
			rlsInfoDtoList.add(rlsBack);
		}

		// 设置丰密运单必要参数
		dto.setRlsInfoDtoList(rlsInfoDtoList);
		// 客户个性化Logo 必须是个可以访问的图片本地路径地址或者互联网图片地址
		// dto.setCustLogo("D:\\ibm.jpg");

		// 备注相关
		dto.setMainRemark(orderRequest.getMainRemark());
		dto.setChildRemark(orderRequest.getChildRemark());
		dto.setReturnTrackingRemark(orderRequest.getReturnTrackingRemark());

		// 加密项
		dto.setEncryptCustName(true);// 加密寄件人及收件人名称
		dto.setEncryptMobile(true);// 加密寄件人及收件人联系手机
		List<CargoInfoDto> cargoInfoList = new ArrayList<CargoInfoDto>();
		if (cargoList != null && cargoList.size() > 0) {
			for (CargoRequest cargo : cargoList) {
				CargoInfoDto cargo1 = new CargoInfoDto();
				cargo1.setCargo(cargo.getCargo());
				cargo1.setCargoCount(cargo.getCargoCount() == null ? 1 : cargo.getCargoCount());
				cargo1.setCargoUnit(StringUtils.isNotBlank(cargo.getCargoUnit()) ? cargo.getCargoUnit() : "");
				cargo1.setSku(StringUtils.isNotBlank(cargo.getSku()) ? cargo.getSku() : "");
				cargo1.setRemark(StringUtils.isNotBlank(cargo.getRemark()) ? cargo.getRemark() : "");
				cargoInfoList.add(cargo1);
			}
			dto.setCargoInfoDtoList(cargoInfoList);
		}

		waybillDtoList.add(dto);

		System.out.println("请求参数： " + MyJsonUtil.object2json(waybillDtoList));

		System.out.println(waybillDtoList.get(0).getRlsInfoDtoList().size());

		ObjectMapper objectMapper = new ObjectMapper();
		StringWriter stringWriter = new StringWriter();
		System.out.println("请求参数2： " + MyJsonUtil.object2json(stringWriter.toString().getBytes()));
		objectMapper.writeValue(stringWriter, waybillDtoList);

		httpConn.getOutputStream().write(stringWriter.toString().getBytes());

		httpConn.getOutputStream().flush();
		httpConn.getOutputStream().close();
		InputStream in = httpConn.getInputStream();

		BufferedReader in2 = new BufferedReader(new InputStreamReader(in));

		String y = "";

		String strImg = "";
		while ((y = in2.readLine()) != null) {

			strImg = y.substring(y.indexOf("[") + 1, y.length() - "]".length() - 1);
			if (strImg.startsWith("\"")) {
				strImg = strImg.substring(1, strImg.length());
			}
			if (strImg.endsWith("\"")) {
				strImg = strImg.substring(0, strImg.length() - 1);
			}

		}

		// 将换行全部替换成空
		strImg = strImg.replace("\\n", "");
		// System.out.println(strImg);

		SimpleDateFormat format = new SimpleDateFormat("yyyyMMdd-HHmmss");
		String dateStr = format.format(new Date());

		if (strImg.contains("\",\"")) {
			// 如子母单及签回单需要打印两份或者以上
			String[] arr = strImg.split("\",\"");

			/** 输出图片到本地 支持.jpg、.png格式 **/
			for (int i = 0; i < arr.length; i++) {
				Base64ImageTools.generateImage(arr[i].toString(), "D:\\qiaoWay" + dateStr + "-" + i + ".jpg");

			}
		} else {
			Base64ImageTools.generateImage(strImg, "D:\\qiaoWaybill" + dateStr + ".jpg");

		}
	}

}
