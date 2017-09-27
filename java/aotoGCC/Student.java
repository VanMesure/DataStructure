package aotoGCC;

public class Student {
	public String username;
	public int qID;
	public String code;
	public String result;
	public String error_info;
	public int status;
	public Student(String username,int qID, String code, String result, String error_info, int status) {
		this.username = username;
		this.qID =qID;
		this.code = code;
		this.result = result;
		this.error_info = error_info;
		this.status = status;
	}
	public void finalize() {
		System.out.println("student对象被回收");
	}
}
