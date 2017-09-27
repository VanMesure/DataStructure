package aotoGCC;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;

import dao.Dao;

public class CFile{
	private static String filePath = "/opt/lampp/htdocs/new/code/pages/compile/";
	private Student s = null;
	private int qID;
	//文件命名规则：  "q" + qID + "_student"||"_test" 
	private String codeFileName;
	private String testFileName;
	private Dao d = Dao.getDao();
	public int num = 0;
	
	//程序是否正常跑完的标志位  0-初始状态  1-死循环  2-非死循环
	private static int finishStatus = 0; 
	
	public CFile() {
		num++;
		System.out.println("生成第 " + num + "个CFile");
	}
	
	public static int getFinishStatus() {
		return finishStatus;
	}
	
	public static void setFinishStatus(int b) {
		finishStatus = b;
	}
	
	private boolean createCFile() {
		//Student s = Dao.getStudent();
		if(s != null) {
			File f= new File(filePath + codeFileName);
			File out = new File(filePath + "a.out");
			try {
				f.delete();
				out.delete();
			}catch(Exception e) {}
			
			try {
				f.createNewFile();
				FileWriter fw = new FileWriter(f);
				fw.write(s.code);
				fw.close();
				return true;
			}catch(Exception e) {
				e.printStackTrace();
			}
		}
		return false;
	}
	
	private String getResult(Process p) throws IOException{
		StringBuffer info = new StringBuffer();
		InputStream is = p.getInputStream();
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);
		while(true) {
			String line = br.readLine();
			if(line != null) {
				info.append(line);
				info.append("\n");
			}else {
				break;
			}
		}
		String infoStr = info.toString();
		br.close();
		isr.close();
		is.close();
		
		return infoStr;
	}
	
	private String getErrorResult(Process p) throws IOException{
		StringBuffer info = new StringBuffer();
		InputStream is = p.getErrorStream();
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);
		while(true) {
			String line = br.readLine();
			if(line != null) {
				info.append(line);
				info.append("\n");
			}else {
				break;
			}
		}
		String infoStr = info.toString();
		br.close();
		isr.close();
		is.close();
		return infoStr;
	}
	
	private void gcc() {
		try {
			Process p = Runtime.getRuntime().exec("gcc " + filePath + testFileName);
			
			//waitFor()在正常情况下（编译通过）会返回0
			if(p.waitFor() != 0) {
				s.status = 1;
				s.result = getErrorResult(p);//如果gcc没有执行成功，执行结果是通过errirInputStream来返回的
				d.updateResult(s);
				return;
			}

			//运行
			//这里的a.out用的相对路径 与jar在同一文件夹下
			p = Runtime.getRuntime().exec("./a.out");
			Timer t = new Timer(p);
			t.setDaemon(true);
			t.start();
			p.waitFor();
			//如果因为死循环被Timer终止 则finishiStatus应该是false
			if(finishStatus == 1) {
				s.status = 2;
				s.result = "运行超时，请检查是否有死循环。（这位童鞋你酱紫会增加服务器压力的很不厚道的说）";
				d.updateResult(s);
				return;
			}else {
				finishStatus = 2;
			}
			
			//可以正常运行（不一定能实现功能）
			//result和error_info感觉有点重复，下面弃用error_info
			s.result = getResult(p);
			char status = s.result.charAt(s.result.length() - 2);
			if((int)(status - 48) == 0) {
				s.status = 3;
			}else {
				s.status = 2;
			}
			d.updateResult(s);
			return;
		}catch(Exception e) {
			e.printStackTrace();
		}
	}
	
	private boolean init() {
		s = d.getStudent();
		if(s != null) {
			setFinishStatus(0);
			this.qID = s.qID;
			this.testFileName = "q" + qID + "_test.c";
			this.codeFileName = "q" + qID + "_student.c";
			return true;
		}else {
			try {
				Thread.sleep(500);
			}catch(Exception e) {
				e.printStackTrace();
			}
			return false;
		}
	}

	public void run() {
		while(true) {
			try {
				Thread.sleep(10);
				s = null;
			}catch(Exception e) {
				e.printStackTrace();
			}
			
			if(!init()) {
				continue;
			}
			if(createCFile()) {
				gcc();
				System.out.println("成功处理 ：" + s.username + "  qID = " + s.qID );
				System.out.println("结果：" + s.result);
			}
		}
	}
	public void finalize() {
		System.out.println("cfile对象被回收");
	}
	
	
}
