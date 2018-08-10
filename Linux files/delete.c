#include<stdio.h>
#include<fcntl.h>
#include<unistd.h>
#include<string.h>
int main(){
int det =unlink("add");
if(det==-1){
perror("delete error\n");
}
else{
printf("file deleted succuessful\n");
}
}
