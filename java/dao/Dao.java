package dao;
import java.io.*;
import java.sql.*;
import aotoGCC.Student;
public class Dao {
	public static Dao d = new Dao();
	private static Connection c;
	private static String table = "student_code";
	
	private Dao() {
		try {
			Class.forName("com.mysql.jdbc.Driver");
			c = DriverManager.getConnection("jdbc:mysql://localhost:3306/newds?characterEncoding=utf-8","root", "");
		}catch(Exception e) {
			e.printStackTrace();
		}
	}
	
	public static Dao getDao() {
		return d;
	}
	
	private Dao reset() {
		try {
			c.close();
			c = DriverManager.getConnection("jdbc:mysql://localhost:3306/newds?characterEncoding=utf-8","root", "");
			d = new Dao();
		}catch(Exception e) {
			e.printStackTrace();
		}
		return d;
	}
	
	public String getCode(String username, int qID) {
		//原则上每个username 和 qID 仅对应一串代码
		String sql = "select code from student_code where username = ? and qID = ?";
		try {
			PreparedStatement ps = c.prepareStatement(sql);
			ps.setString(1, table);
			ps.setString(2, username);
			ps.setInt(3, qID);
			ResultSet result = ps.executeQuery();
			if(result.next()) {
				ps.close();
				result.close();
				return result.getString(1);
			}
			ps.close();
			result.close();
		}catch(Exception e) {
			e.printStackTrace();
		}
		return "";
	}
	
	public Student getStudent() {
		String sql = "select * from student_code where status = 0";
		try {
			PreparedStatement ps = c.prepareStatement(sql);
//			ps.setString(1, table);
			ResultSet result = ps.executeQuery();
			if(result.next()) {
				String username = result.getString(1);
				int qID = result.getInt(2);
				String code = result.getString(3);
				String r = result.getString(4);
				String error_info = result.getString(5);
			//	int status = result.getInt(6);
				ps.close();
				result.close();
				return new Student(username,qID,code,r,error_info,0);
			}
			ps.close();
			result.close();
		}catch(Exception e) {
			e.printStackTrace();
		}
		return null;
	}
	public void updateResult(Student s) {
		String sql = "update student_code set  result = ?, status = ? where username = ? and qID = ?";
		try {
			PreparedStatement ps = c.prepareStatement(sql);
			ps.setString(1, s.result);
			ps.setInt(2, s.status);
			ps.setString(3, s.username);
			ps.setInt(4, s.qID);
			ps.executeUpdate();
			ps.close();
		}catch(Exception e) {
			e.printStackTrace();
		}
	}
	
	
}
