// Create a program that will ask for the size of an array, afterwhich fully populate the array
// After the array is populated, double all the even numbers in the array, and triple all the odd numbers in the array

#include <stdio.h>

int main() {
    int array[100];
    int orgvalue[100];
    int sizearray, i;
    
    printf("Enter array size: ");
    scanf("%d", &sizearray);
    
    for (i = 0; i < sizearray; i++){
        scanf("%d", &array[i]);
        orgvalue[i] = array[i];
    }
    
    printf("Original: [");
    for (i = 0; i < sizearray; i++) {
        printf("%d", array[i]);
        if (i < sizearray - 1)
            printf(", ");
    }
    printf("]\n");
    
    for (i = 0; i < sizearray; i++){
        if (array[i] % 2 == 0){
            array[i] = array[i] * 2;
        } else {
            array[i] = array[i] * 3;
        }
    }
    
    printf("New: [");
    for (i = 0; i < sizearray; i++) {
        printf("%d", array[i]);
        if (i < sizearray - 1)
            printf(", ");
    }
    printf("]\n");

// Create 2 new arrays: evenArr & addArr. Move all the even numbers from the original array to even Arr, and move all odd numbers to oddArr.
    int evenArr[100];
    int evenCount = 0;
    int oddArr[100];
    int oddCount = 0;
    
    for (i = 0; i < sizearray; i++){
        if (array[i] % 2 == 0){
            evenArr[evenCount] = orgvalue[i];
            evenCount = evenCount + 1;
        } else if (array[i] % 3 == 0){
            oddArr[oddCount] = orgvalue[i] ;
            oddCount = oddCount + 1;
        }
    }
    
    printf("Even: [");
    for (i = 0; i < evenCount; i++) {
        printf("%d", evenArr[i]);
        if (i < evenCount - 1)
            printf(", ");
    }
    printf("]\n");
    
    printf("Odd: [");
    for (i = 0; i < oddCount; i++) {
        printf("%d", oddArr[i]);
        if (i < oddCount - 1)
            printf(", ");
    }
    printf("]\n");
}