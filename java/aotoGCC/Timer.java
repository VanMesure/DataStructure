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
			//һ��ʼ��3000 ����ݹ��ʱ��ò���е㲻�� �����ʵ��ӳ���
			if(processTime >= 5000) {
				p.destroy();
				//System.out.println("���г�ʱ�������Ƿ�����ѭ��");
				CFile.setFinishStatus(1);
				return;
			}
			if(CFile.getFinishStatus() == 2) {
				//System.out.println("�������");
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
		System.out.println("student���󱻻���");
	}
}
