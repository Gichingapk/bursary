#include<stdio.h>
#include<fcntl.h>
#include<unistd.h>
#include<string.h>
int main(){
//file opening/creating
int fd;
int fd2;
char buf[100];

char str[5]= "nyeri";
write(fd,str,strlen(str));

fd=open("newfile.txt",O_RDWR|O_APPEND);
if(fd==-1){
perror("open error");
}
else{
printf("\nfile created successful\n");
}

fd2=read(fd,buf,100);
if(fd2==-1){
perror("read error");
}
else{
printf("read successful: %s \n",buf);
}
close(fd);
close(fd2);

}
