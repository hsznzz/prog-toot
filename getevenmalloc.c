#include <stdio.h>
#include <stdlib.h>

int * getEven(int array[], int sizearray, int *evenCount);

int main() {
    int array[100];
    int sizearray, i;
    int evenCount = 0;
    int *evenArr;
    
    printf("Enter array size: ");
    scanf("%d", &sizearray);
    
    for (i = 0; i < sizearray; i++) {
        printf("Enter value %d: ", i+1);
        scanf("%d", &array[i]);
    }
    
    printf("\n");
    
    printf("Original: [");
    for (i = 0; i < sizearray; i++) {
        printf("%d", array[i]);
        if (i < sizearray - 1)
            printf(", ");
    }
    printf("]\n");
    
    evenArr = getEven(array, sizearray, &evenCount);
    
    printf("Even: [");
    for (i = 0; i < evenCount; i++) {
        printf("%d", evenArr[i]);
        if (i < evenCount - 1) {
            printf(", ");
        }
    }
    printf("]\n");
    
    free(evenArr);
}

// Create a function that gets all the even numbers and counts them precisely
int * getEven(int array[], int sizearray, int *evenCount) {
    int *evenArr;
    int i;
    *evenCount = 0;
    
    for (i = 0; i < sizearray; i++) {
        if (array[i] % 2 == 0) {
            (*evenCount)++;
        }
    }
    
    evenArr = malloc(sizeof(int) * *evenCount);
    
    
    int dar = 0; // separate index for dar
    for (i = 0; i < sizearray; i++) {
        if (array[i] % 2 == 0) {
            evenArr[dar++] = array[i];
        }
    }
    
    return evenArr;
}