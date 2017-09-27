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
	//�ļ���������  "q" + qID + "_student"||"_test" 
	private String codeFileName;
	private String testFileName;
	private Dao d = Dao.getDao();
	public int num = 0;
	
	//�����Ƿ���������ı�־λ  0-��ʼ״̬  1-��ѭ��  2-����ѭ��
	private static int finishStatus = 0; 
	
	public CFile() {
		num++;
		System.out.println("���ɵ� " + num + "��CFile");
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
			
			//waitFor()����������£�����ͨ�����᷵��0
			if(p.waitFor() != 0) {
				s.status = 1;
				s.result = getErrorResult(p);//���gccû��ִ�гɹ���ִ�н����ͨ��errirInputStream�����ص�
				d.updateResult(s);
				return;
			}

			//����
			//�����a.out�õ����·�� ��jar��ͬһ�ļ�����
			p = Runtime.getRuntime().exec("./a.out");
			Timer t = new Timer(p);
			t.setDaemon(true);
			t.start();
			p.waitFor();
			//�����Ϊ��ѭ����Timer��ֹ ��finishiStatusӦ����false
			if(finishStatus == 1) {
				s.status = 2;
				s.result = "���г�ʱ�������Ƿ�����ѭ��������λͯЬ�㽴�ϻ����ӷ�����ѹ���ĺܲ������˵��";
				d.updateResult(s);
				return;
			}else {
				finishStatus = 2;
			}
			
			//�����������У���һ����ʵ�ֹ��ܣ�
			//result��error_info�о��е��ظ�����������error_info
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
				System.out.println("�ɹ����� ��" + s.username + "  qID = " + s.qID );
				System.out.println("�����" + s.result);
			}
		}
	}
	public void finalize() {
		System.out.println("cfile���󱻻���");
	}
	
	
}
