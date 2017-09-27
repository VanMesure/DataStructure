int Fsequence(int n){
	if(n == 0){
		return 0;
	}
	if(n == 1 || n == 2){
		return 1;
	}
	return (Fsequence(n - 1) + Fsequence(n - 2));
}