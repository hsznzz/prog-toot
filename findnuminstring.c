// Create a function findNumbers where it would tell what words has numbers in it
// Expected output: 
// Enter a string: Thi2 is a str1ng
// The word 1 4 contains a number

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int *findNumbers(char string[], int *num);

void main(){
    char string[50];
    int num;
    int i;
    int *count;
    
    printf("Enter a string: ");
    scanf("%[^\n]", string);
    
    count = findNumbers(string, &num);
    
    printf("The word %d %d contains a number", count);
}

int *findNumbers(char string[], int *num){
    int i;
    int *count;
    int word;
    
    for(i = 0; i < 50; i++){
        if(string[i] > '0' && string[i] < '9'){
            flag = 1;
        }
        if(string[i] = ' ' && flag == 1){
            *num = *num + 1;
        }
    }
    
    count = malloc(sizeof(int) * (*num));
    
    for(i = 0; i < 50; i++){
        if(string[i] > '0' && string[i] < '9'){
            flag = 1;
        }
        if(string[i] = ' '){
            word = word + 1
            
        }
        if(string[i] = ' ' && flag == 1){
            count[j++] = word;
        }
    }
    
    return count;
}