// Create a function findBad where it would count how many words has an asterisk which counts as bad bad bad oki gl
// Example output: You are a fu***** b****

//Advanced: try f****g b***h

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

char findBad(char words[], int *amountword);
 
void main(){
    char words[100];
    int amountword = 0;
    
    printf("Input to count the swear words: ");
    scanf("%[^\n]", words);
    
    findBad(words, &amountword);
    
    printf("Amount of swear words: %d", amountword);                                  // code for finding swear words
    
}

 char findBad(char words[], int *amountword){
    int i = 0;
    int flag = 0;
    for(i = 0; i < 100; i++){
        if(words[i] == '*'){
            flag = 1;
        }
        if(words[i] == ' ' && flag == 1){
            *amountword = *amountword + 1;
            flag = 0;
        } 
    }
    
    return *amountword;
}



