package aotoGCC;

class Timer extends Thread{
	Process p;
	Timer(Process p){
		this.p = p;
	}
	public void run() {
		long startTime = System.currentTimeMillis();
		while(true) {
			int processTime = (int)(System.currentTimeMillis() - startTime);
			//一开始是3000 处理递归的时候貌似有点不妥 所以适当加长点
			if(processTime >= 5000) {
				p.destroy();
				//System.out.println("运行超时，请检查是否有死循环");
				CFile.setFinishStatus(1);
				return;
			}
			if(CFile.getFinishStatus() == 2) {
				//System.out.println("运行完成");
				return;
			}
			try {
				Thread.sleep(500);
			}catch(Exception e) {
				e.printStackTrace();
			}
		}
	}
	public void finalize() {
		System.out.println("student对象被回收");
	}
}
