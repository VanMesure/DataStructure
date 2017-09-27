#include <stdio.h>
#include <stdlib.h>
#include "q2_student.c"


//return the No.n num of F

int Fsequence_test(int n){
	if(n == 0){
		return 0;
	}
	if(n == 1 || n == 2){
		return 1;
	}
	return (Fsequence(n - 1) + Fsequence(n - 2));
}




int main()
{
	/* code */
	int i = 10;
	srand(time(0));
	int a; 
	for(i; i > 0; i--){
		//这个数值千万不能调大了。。大规模的递归计算会被服务器当作死循环kill掉的
		a = rand()  % 20 + 1;
		printf("尝试获取第%d项的值，结果为 %d，", a, Fsequence(a));
		if(Fsequence_test(a) != Fsequence(a)){
			printf("结果错误，请重新检查\n");
			printf("1");
			return 1;
		}
		printf("结果正确!\n");
	}
	printf("测试通过！\n");
	printf("0");
	return 0;
}