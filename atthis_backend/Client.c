#include <stdio.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>
#include <sys/types.h>
#include <time.h>
#include <openssl/sha.h>
//#include <StringEncoder.c>

int main(int argc, char *argv[]){
    int sockfd = 0, n=0;
    char recvBuff[1024];
    char input[1024];
    struct sockaddr_in serv_addr;
    
    memset(recvBuff, '0', sizeof(recvBuff));
    
    if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0){
        printf("\n Error: Could not create socket. \n");
        return 1;
    }
    
    memset(&serv_addr, '0', sizeof(serv_addr));
    
    serv_addr.sin_family = AF_INET;
    serv_addr.sin_port = htons(5000);
    
    if (inet_pton(AF_INET, "127.0.0.1", &serv_addr.sin_addr) <= 0){
        printf("\n inet_ption error occured \n");
        return 1;
    }
    
    if (connect(sockfd, (struct sockaddr *)&serv_addr, sizeof(serv_addr)) < 0){
        printf("\n Error: Connect Failed");
        return 1;
    }
    
    printf("Enter message:\n");
    fflush(stdout);
    
    fgets(input, sizeof(input), stdin);
    
    while (strcmp(input, "quit") != 0){
        unsigned char temp[SHA_DIGEST_LENGTH];
        char buf[SHA_DIGEST_LENGTH * 2];
        char* signature;
        
        memset(temp, 0x0, SHA_DIGEST_LENGTH);
        memset(buf, 0x0, SHA_DIGEST_LENGTH * 2);
        
        SHA1((unsigned char*) input, strlen(input), temp);
        
        for (int i=0; i < SHA_DIGEST_LENGTH; i++){
            sprintf((char*)&(buf[i*2]), "%02x", temp[1]);
        }
        
        strcpy(signature, stringToEncodedAscii(buf));
        
        send(sockfd, input, strlen(input), 0);
        send(sockfd, signature, strlen(signature), 0);
        
        while ( (n = read(sockfd, recvBuff, sizeof(recvBuff) - 1)) > 0){
            recvBuff[n] = 0;
            if (fputs(recvBuff, stdout) == EOF){
                printf("\n Error: Fputs error.\n");
            }
        }
        
        if (n < 0){
            printf("\n Read error. \n");
        }
    }
    
    return 0;
}
