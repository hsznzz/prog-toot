#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int* arrayCleaning(int arr[],int count, int* cleanedCount);
int display(int *arr,int cleanedCount);

int display(int *arr, int cleanedCount)
{
    if (cleanedCount == 0)
    {
        printf("\nOh no Data is fully corrupted and cannot be recovered!\n");
    }
    else
    {
        printf("Data has been recovered!\n");
        printf("Cleaned Data:");
        for (int i = 0 ; i < cleanedCount ; i++)
        {
            printf(" %d ",arr[i]);
        }
    }
}
int* arrayCleaning(int arr[],int count, int* cleanedCount)
{
    int flag = 0;
    int bad = -1;
    int j = 0;
    for (int i = 0 ; i < count ; i++)
    {
        if (arr[i] == bad && flag == 0)
        {
            flag++;
            continue;
        }
        else if (arr[i] == bad && flag == 1)
        {
            flag--;
            continue;
        }
        else if (arr[i] != bad && flag == 0)
        {
            ++(*cleanedCount);
        }
    }
    int *cleanedArr = malloc(sizeof(int) * *cleanedCount);
    //Go thru array and count uncorrupted
    for (int i = 0 ; i < count ; i++)
    {
        if (arr[i] == bad && flag == 0)
        {
            flag++;
            continue;
        }
        else if (arr[i] == bad && flag == 1)
        {
            flag--;
            continue;
        }
        else if (arr[i] != bad && flag == 0)
        {
            cleanedArr[j++] = arr[i];
        }
    }
    return cleanedArr;
}

int main(){
    int arr[100];
    int arrCount=0;
    int *cleanedArr;
    int *cleanedCount;
    *cleanedCount = 0;
    printf("Input how many items in the array: ");
    scanf("%d",&arrCount);
    printf("Input Array Values: ");
    for (int i = 0 ; i < arrCount ; i++)
    {
        scanf("%d",&arr[i]);
    }
    cleanedArr=arrayCleaning(arr, arrCount, cleanedCount);
    
    display(cleanedArr,*cleanedCount);

}