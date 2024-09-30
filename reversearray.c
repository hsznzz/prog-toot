#include <stdio.h>
#include <stdlib.h>

int *reverseArray(int arr[], int *sizearr);

int main(){
    int arr[50];
    int sizearr, i = 0;
    int *newarr;
    
    
    printf("Enter the size of array: ");
    scanf("%d", &sizearr);
    
    for(i = 0; i < sizearr; i++){
        printf("Enter element %d: ", i + 1);
        scanf("%d", &arr[i]);
    }
    
    printf("Original array: [");
    for(i = 0; i < sizearr; i++){
        printf("%d", arr[i]);
        if(i < sizearr - 1){
            printf(", ");
        }
    }
    printf("]\n");
    
    newarr = reverseArray(arr, &sizearr);
    
    printf("Reverse array: [");
    for(i = 0; i < sizearr; i++){
        printf("%d", newarr[i]);
        if(i < sizearr - 1){
            printf(", ");
        }
    }
    printf("]");
}


int *reverseArray(int arr[], int *sizearr){
    int i;
    int *newarr;
    int dar = -1;
    int count = *sizearr;
    
    newarr = malloc (sizeof(int) * (*sizearr));
    for(i = count; i >= 0; i--){
        newarr[dar] = arr[i];
        dar++;
    }
    
    return newarr;
}