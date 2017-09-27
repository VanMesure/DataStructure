#include <stdio.h>
#include <stdlib.h>
#include "q1_student.c"
/*
void sortABC_test(int *a, int *b, int *c){
	int temp;
	if(*b < *a){
		temp = *b;
		*b = *a;
		*a = temp;
	}
	if(*c < *b){
		temp = *c;
		*c = *b;
		*b = temp;
	}
	if(*b < *a){
		temp = *b;
		*b = *a;
		*a = temp;
	}
}
*/
//状态码 0：通过   1：未通过  
int main(){
	int a,b,c,n;
	srand(time(0));
	for(n=0 ; n<10; ++n){
		a = rand() % 100;
		b = rand() % 100;
		c = rand() % 100;
		printf("将参数%d ,%d ,%d 传入提交的函数中\n",a, b, c);
		//测试用例子
		sortABC( &a, &b, &c);
		if( !(a<=b && b<=c) ){
			printf("结果为%d ,%d ,%d\n",a, b, c);
			printf("测试未通过，请重新检查\n");
			printf("1");
			return 1;
		}
		printf("结果为%d ,%d ,%d  正确！\n",a, b, c);
	}
	printf("测试通过！\n");
	printf("0");
	return 0;
}