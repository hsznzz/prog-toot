// Write a function swap that swaps the values of three integers x, y, and z. 
// x is swapped to y, then y to z, and lastly z to x.
// In the main function, write a program that asks for three integer inputs and pass in the reference of those variables by calling swap function

#include <stdio.h>

int swap (int*, int*, int*);

int main(){
    int x, y, z;

    printf("Enter x: ");
    scanf("%d", &x);
    printf("Enter y: ");
    scanf("%d", &y);
    printf("Enter z: ");
    scanf("%d", &z);

    printf("\nBefore: %d, %d, %d\n", x, y ,z);

    swap (&x, &y, &z);

    printf("After: %d, %d, %d", x, y ,z);
}

int swap (int *a, int *b, int *c){
    int temp;

    temp = *a;
    *a = *b;
    *b = *c;
    *c = temp;
}

