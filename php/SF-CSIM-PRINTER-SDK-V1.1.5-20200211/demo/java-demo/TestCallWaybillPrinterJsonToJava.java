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

import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.sf.dto.CargoInfoDto;
import com.sf.dto.JsonRlsInfoDto;
import com.sf.dto.JsonWaybillDto;
import com.sf.dto.RlsInfoDto;
import com.sf.dto.WaybillDto;
import com.sf.util.Base64ImageTools;
import com.sf.util.MyJsonUtil;
import com.sf.util.XmlToJavaBeanUtil;

public class TestCallWaybillPrinterJsonToJava {
	
	/**此测试类供通过JSON报文调用运单SDK使用**/

	public static void main(String[] args) throws Exception {
		String reqPathname = "D:\\TXT\\json\\JSONorder.txt";// json文件所在绝对路径
		String jsonReq = "";// json字符串
		TestCallWaybillPrinterJsonToJava.WayBillPrinterTools(reqPathname, jsonReq);

	}

	public static void WayBillPrinterTools(String reqPathname, String jsonReq) throws Exception {

		

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
		String jsonStr = null;
		if (StringUtils.isNotBlank(reqPathname)) {
			jsonStr = XmlToJavaBeanUtil.readFile(reqPathname);
		} else if (StringUtils.isNotBlank(jsonReq)) {
			jsonStr = jsonReq;
		}
		if (StringUtils.isBlank(jsonStr)) {
			return;
		}
		ObjectMapper mapper = new ObjectMapper();
		JsonWaybillDto waybillDto = mapper.readValue(jsonStr, JsonWaybillDto.class);
		 JsonNode node = mapper.readTree(jsonStr);
		 JsonNode node1= node.get("rlsInfoDtoList");
		 String node1Str=node1.toString();
		// String name=node.get("twoDimensionCode").toString();
		 List<JsonRlsInfoDto> jsonRlsInfoList = mapper.readValue(node1Str,new TypeReference<List<JsonRlsInfoDto>>() { });
		 List<RlsInfoDto> rlsInfoList = new ArrayList<RlsInfoDto>();
		 for (JsonRlsInfoDto jsonRlsInfoDto : jsonRlsInfoList) {
			 RlsInfoDto rlsInfoDto=new RlsInfoDto();
			 rlsInfoDto.setAbFlag(jsonRlsInfoDto.getAbFlag());
			 rlsInfoDto.setCodingMapping(jsonRlsInfoDto.getCodingMapping());
			 rlsInfoDto.setCodingMappingOut(jsonRlsInfoDto.getCodingMappingOut());
			 rlsInfoDto.setDestRouteLabel(jsonRlsInfoDto.getDestRouteLabel());
			 rlsInfoDto.setDestTeamCode(jsonRlsInfoDto.getDestTeamCode());
			 rlsInfoDto.setPrintIcon(jsonRlsInfoDto.getPrintIcon());
			 rlsInfoDto.setProCode(jsonRlsInfoDto.getProCode());
			 rlsInfoDto.setQRCode(jsonRlsInfoDto.getTwoDimensionCode());
			 rlsInfoDto.setSourceTransferCode(jsonRlsInfoDto.getSourceTransferCode());
			 rlsInfoDto.setWaybillNo(jsonRlsInfoDto.getWaybillNo());
			 rlsInfoDto.setXbFlag(jsonRlsInfoDto.getXbFlag());
			 rlsInfoDto.setSourceTransferCode(jsonRlsInfoDto.getSourceTransferCode());
			 rlsInfoList.add(rlsInfoDto);
		}
		// 获取cargo对象
		List<CargoInfoDto> cargoList = waybillDto.getCargoInfoDtoList();
		//List<JsonRlsInfoDto> rlsInfoList = waybillDto.getRlsInfoDtoList();
		List<WaybillDto> waybillDtoList = new ArrayList<WaybillDto>();
	    WaybillDto dto = new WaybillDto();

		// 这个必填
		dto.setAppId(waybillDto.getAppId());// 对应clientCode
		dto.setAppKey(waybillDto.getAppKey());// 对应checkWord

		String mailno = waybillDto.getMailNo();// 主运单号
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
		dto.setReturnTrackingNo(waybillDto.getReturnTrackingNo());
		// 收件人信息
		dto.setConsignerProvince(waybillDto.getConsignerProvince());
		dto.setConsignerCity(waybillDto.getConsignerCity());
		dto.setConsignerCounty(waybillDto.getConsignerCounty());
		dto.setConsignerAddress(waybillDto.getConsignerAddress()); // 详细地址建议最多30个字
		// 字段过长影响打印效果
		dto.setConsignerCompany(waybillDto.getConsignerCompany());
		dto.setConsignerName(waybillDto.getConsignerName());
		dto.setConsignerShipperCode(waybillDto.getConsignerShipperCode());
		if(StringUtils.isBlank(waybillDto.getConsignerMobile()) && StringUtils.isNotBlank(waybillDto.getConsignerTel())){
			dto.setConsignerMobile(waybillDto.getConsignerTel());
		}else if(StringUtils.isNotBlank(waybillDto.getConsignerMobile()) && StringUtils.isBlank(waybillDto.getConsignerTel())){
			dto.setConsignerMobile(waybillDto.getConsignerMobile());
		}else if(StringUtils.isNotBlank(waybillDto.getConsignerMobile()) && StringUtils.isNotBlank(waybillDto.getConsignerTel())){
			dto.setConsignerMobile(waybillDto.getConsignerMobile());
			dto.setConsignerTel(waybillDto.getConsignerTel());
		}
		// 寄件人信息
		dto.setDeliverProvince(waybillDto.getDeliverProvince());
		dto.setDeliverCity(waybillDto.getDeliverCity());
		dto.setDeliverCounty(waybillDto.getDeliverCounty());
		dto.setDeliverCompany(waybillDto.getDeliverCompany());
		dto.setDeliverAddress(waybillDto.getDeliverAddress());// 详细地址建议最多30个字
																// 字段过长影响打印效果
		dto.setDeliverName(waybillDto.getDeliverName());
		dto.setDeliverShipperCode(waybillDto.getDeliverShipperCode());
		if(StringUtils.isBlank(waybillDto.getDeliverMobile()) && StringUtils.isNotBlank(waybillDto.getDeliverTel())){
			dto.setDeliverMobile(waybillDto.getDeliverTel());
		}else if(StringUtils.isNotBlank(waybillDto.getDeliverMobile()) && StringUtils.isBlank(waybillDto.getDeliverTel())){
			dto.setDeliverMobile(waybillDto.getDeliverMobile());
		}else if(StringUtils.isNotBlank(waybillDto.getDeliverMobile()) && StringUtils.isNotBlank(waybillDto.getDeliverTel())){
			dto.setDeliverMobile(waybillDto.getDeliverMobile());
			dto.setDeliverTel(waybillDto.getDeliverTel());
		}
		
		dto.setDestCode(waybillDto.getDestCode());// 目的地代码 参考顺丰地区编号
		dto.setZipCode(waybillDto.getZipCode());// 原寄地代码 参考顺丰地区编号
		// 陆运E标示
		// 业务类型为“电商特惠、顺丰特惠、电商专配、陆运件”则必须打印E标识，用以提示中转场分拣为陆运
		dto.setElectric("E");
		// 快递类型
		// 1 ：标准快递 2.顺丰特惠 3： 电商特惠 5：顺丰次晨 6：顺丰即日 7.电商速配 15：生鲜速配
		dto.setExpressType(waybillDto.getExpressType());

		// COD代收货款金额,只需填金额, 单位元- 此项和月结卡号绑定的增值服务相关
		dto.setCodValue(waybillDto.getCodValue());
		dto.setInsureValue(waybillDto.getInsureValue());// 声明货物价值的保价金额,只需填金额,单位元
		dto.setMonthAccount(waybillDto.getMonthAccount());// 月结卡号
		dto.setPayMethod(waybillDto.getPayMethod());//

		// 获取主运单信息
	    RlsInfoDto mainRlsRlsInfo = new RlsInfoDto();

		Iterator<RlsInfoDto> it = rlsInfoList.iterator();
		while (it.hasNext()) {
			RlsInfoDto rlsInfoResponse = it.next();
			String waybillNo = rlsInfoResponse.getWaybillNo();
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
		// RlsDetailResponse mainRlsDetail = mainRlsRlsInfo.getRlsDetailRes();
		/** 丰密运单相关-如非使用丰密运单模板 不需要设置以下值 **/

		List<RlsInfoDto> rlsInfoDtoList = new ArrayList<RlsInfoDto>();
		RlsInfoDto rlsMain = new RlsInfoDto();
		// 主运单号
		rlsMain.setWaybillNo(mainRlsRlsInfo.getWaybillNo());
		rlsMain.setDestRouteLabel(
				StringUtils.isNotBlank(mainRlsRlsInfo.getDestRouteLabel()) ? mainRlsRlsInfo.getDestRouteLabel() : "");
		rlsMain.setPrintIcon(
				StringUtils.isNotBlank(mainRlsRlsInfo.getPrintIcon()) ? mainRlsRlsInfo.getPrintIcon() : "");
		rlsMain.setProCode(StringUtils.isNotBlank(mainRlsRlsInfo.getProCode()) ? mainRlsRlsInfo.getProCode() : "");
		rlsMain.setAbFlag(StringUtils.isNotBlank(mainRlsRlsInfo.getAbFlag()) ? mainRlsRlsInfo.getAbFlag() : "");
		rlsMain.setXbFlag(StringUtils.isNotBlank(mainRlsRlsInfo.getXbFlag()) ? mainRlsRlsInfo.getXbFlag() : "");
		rlsMain.setCodingMapping(
				StringUtils.isNotBlank(mainRlsRlsInfo.getCodingMapping()) ? mainRlsRlsInfo.getCodingMapping() : "");
		rlsMain.setCodingMappingOut(StringUtils.isNotBlank(mainRlsRlsInfo.getCodingMappingOut())
				? mainRlsRlsInfo.getCodingMappingOut() : "");
		rlsMain.setDestTeamCode(
				StringUtils.isNotBlank(mainRlsRlsInfo.getDestTeamCode()) ? mainRlsRlsInfo.getDestTeamCode() : "");
		rlsMain.setSourceTransferCode(StringUtils.isNotBlank(mainRlsRlsInfo.getSourceTransferCode())
				? mainRlsRlsInfo.getSourceTransferCode() : "");
		// 对应下订单设置路由标签返回字段twoDimensionCode 该参
		rlsMain.setQRCode(StringUtils.isNotBlank(mainRlsRlsInfo.getQRCode()) ? mainRlsRlsInfo.getQRCode() : "");
		rlsInfoDtoList.add(rlsMain);

		// 获取签回单信息
		if (StringUtils.isNotBlank(dto.getReturnTrackingNo())) {
			RlsInfoDto rlsInfoResReturn = rlsInfoList.get(0);
			RlsInfoDto rlsBack = new RlsInfoDto();
			// 签回运单号Z
			rlsBack.setWaybillNo(dto.getReturnTrackingNo());
			rlsBack.setDestRouteLabel(StringUtils.isNotBlank(rlsInfoResReturn.getDestRouteLabel())
					? rlsInfoResReturn.getDestRouteLabel() : "");
			rlsBack.setPrintIcon(
					StringUtils.isNotBlank(rlsInfoResReturn.getPrintIcon()) ? rlsInfoResReturn.getPrintIcon() : "");
			rlsBack.setProCode(
					StringUtils.isNotBlank(rlsInfoResReturn.getProCode()) ? rlsInfoResReturn.getProCode() : "");
			rlsBack.setAbFlag(StringUtils.isNotBlank(rlsInfoResReturn.getAbFlag()) ? rlsInfoResReturn.getAbFlag() : "");
			rlsBack.setXbFlag(StringUtils.isNotBlank(rlsInfoResReturn.getXbFlag()) ? rlsInfoResReturn.getXbFlag() : "");
			rlsBack.setCodingMapping(StringUtils.isNotBlank(rlsInfoResReturn.getCodingMapping())
					? rlsInfoResReturn.getCodingMapping() : "");
			rlsBack.setCodingMappingOut(StringUtils.isNotBlank(rlsInfoResReturn.getCodingMappingOut())
					? rlsInfoResReturn.getCodingMappingOut() : "");
			rlsBack.setDestTeamCode(StringUtils.isNotBlank(rlsInfoResReturn.getDestTeamCode())
					? rlsInfoResReturn.getDestTeamCode() : "");
			rlsBack.setSourceTransferCode(StringUtils.isNotBlank(rlsInfoResReturn.getSourceTransferCode())
					? rlsInfoResReturn.getSourceTransferCode() : "");
			// 对应下订单设置路由标签返回字段twoDimensionCode 该参
			rlsBack.setQRCode(rlsInfoResReturn.getQRCode());
			rlsInfoDtoList.add(rlsBack);
		}

		// 设置丰密运单必要参数
		dto.setRlsInfoDtoList(rlsInfoDtoList);
		// 客户个性化Logo 必须是个可以访问的图片本地路径地址或者互联网图片地址
		// dto.setCustLogo("D:\\ibm.jpg");

		// 备注相关
		dto.setMainRemark(waybillDto.getMainRemark());
		dto.setChildRemark(waybillDto.getChildRemark());
		dto.setReturnTrackingRemark(waybillDto.getReturnTrackingRemark());

		// 加密项
		dto.setEncryptCustName(true);// 加密寄件人及收件人名称
		dto.setEncryptMobile(true);// 加密寄件人及收件人联系手机
		List<CargoInfoDto> cargoInfoList = new ArrayList<CargoInfoDto>();
		if (cargoList != null && cargoList.size() > 0) {
			for (CargoInfoDto cargo : cargoList) {
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
