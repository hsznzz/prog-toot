// Create two arrays (arr1, arr2) that takes inputs and its size and then create a function that would find the similar even numbers 
// in both arrays after print the even numbers that are found in both arrays.

#include <stdio.h>
#include <stdlib.h>

int *findEven(int arr1[], int arr2[], int arrsize1, int arrsize2, int *newarrsize);

int main(){
    int arr1[20];
    int arr2[20];
    int arrsize1;
    int arrsize2;
    int newarrsize = 0;
    int *newarr;
    int i;
    
    printf("Enter the size of the first array: ");
    scanf("%d", &arrsize1);
    printf("Enter the size of the second array: ");
    scanf("%d", &arrsize2);
    
    
    printf("Enter the values of the first array:\n");                                  //code for even elements found in two arrays
    for(i = 0; i < arrsize1; i++){
        printf("Value %d: ", i + 1);
        scanf("%d", &arr1[i]);
    }
    
    printf("\nEnter the values of the second array:\n");
    for(i = 0; i < arrsize2; i++){
        printf("Value %d: ", i + 1);
        scanf("%d", &arr2[i]);
    }
    
    newarr = findEven(arr1, arr2, arrsize1, arrsize2, &newarrsize);

    printf("\nEven elements in the array: [");
    for(i = 0; i < newarrsize; i++){
        printf("%d", newarr[i]);
        if(i < newarrsize - 1){
            printf(",");
        }
    }
    printf("]");
}

int *findEven(int arr1[], int arr2[], int arrsize1, int arrsize2, int *newarrsize){
    int i = 0, j = 0, z = 0;
    int count;
    int *newarr;

    if(arrsize1 < arrsize2){
        count = arrsize2;
    } else {
        count = arrsize1;
    }
    
    for(i = 0; i < count; i++){
        for(j = 0; j < count; j++){
            if(arr1[i] % 2 == 0 && arr1[i] == arr2[j]){
                if(arr1[i] == arr2[j]){
                *newarrsize = *newarrsize + 1;
                }
            }
        }
    }

    newarr = malloc(sizeof(int) * (*newarrsize));
    
    for(i = 0; i < count; i++){
        for(j = 0; j < count; j++){
            if(arr1[i] % 2 == 0 && arr1[i] == arr2[j]){
                if(arr1[i] == arr2[j]){
                newarr[z++] = arr2[j];
                }
            }
        }
    }
    

    return newarr;
}