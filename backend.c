#include<stdio.h>
#include<wiringPi.h>
int main(){
	wiringPiSetup();
	pinMode(0,OUTPUT);pinMode(1,OUTPUT);pinMode(2,INPUT);
	int light=0,mode=0;
	while(1){
		FILE *lightState=fopen("lightState.txt","r");
		FILE *deviceMode=fopen("deviceMode.txt","r");
		light=fgetc(lightState);
		mode=fgetc(deviceMode);
		if(mode=='0'||mode=='1'){
			if(mode=='0'){digitalWrite(1,HIGH);}
			else if(mode=='1'){digitalWrite(1,LOW);
				if(light=='0'||light=='1'){
					if(light=='0'){digitalWrite(0,HIGH);}
					else if(light=='1'){digitalWrite(0,LOW);}
				}
			}
		}
	fclose(lightState);fclose(deviceMode);
	}
return 0;
}
