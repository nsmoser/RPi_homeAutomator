#include<stdio.h>
#include<wiringPi.h>
int main(){
	wiringPiSetup();
	pinMode(0,OUTPUT);
	int light=0;
	while(1){
		FILE *lightState=fopen("lightState.txt","r");
		light=fgetc(lightState);
		if(light=='0'||light=='1'){
			if(light=='0'){digitalWrite(0,HIGH);}
			else if(light=='1'){digitalWrite(0,LOW);}
		}
	fclose(lightState);
	}
	return 0;
}
