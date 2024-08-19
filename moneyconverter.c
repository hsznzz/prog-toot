#include <stdio.h>
#include <string.h>

// Create a program that converts an amount of money from one currency to another.
// The program should ask the user to enter the amount of money, the original currency
// (USD, EUR, or JPY), and the target currency (USD, EUR, or JPY). Use a switch statement
// to determine the conversion rate based on the user's input and display the converted
// amount.

// CONVERTION RATES:
// - USD to EUR: 0.84
// - USD to JPY: 109.81
// - EUR to USD: 1.19
// - EUR to JPY: 130.46
// - JPY to USD: 0.0091
// - JPY to EUR: 0.007


/* ANSWER: if-else statement */
// int main(){
//     float money;
//     char currency[5];
//     char target[5];
//     float newvalue;

//     printf("Enter the amount of money: ");
//     scanf("%f", &money);

//     printf("Enter the original currency (USD, EUR, JPY): ");
//     scanf("%3s", currency);
    
//     printf("Enter the target currency exchange (USD, EUR, JPY): ");
//     scanf("%3s", target);

    
//     if (strcmp(currency, "USD") == 0){
//         if (strcmp(target, "EUR") == 0) {
//             newvalue = money * 0.84;
//             printf("%.2f USD is %.2f EUR", money, newvalue);
//         } else if (strcmp(target, "JPY") == 0){
//             newvalue = money * 109.81;
//             printf("%.2f USD is %.2f JPY", money, newvalue);
//         }
//     }
    
//     else if (strcmp(currency, "EUR") == 0) {
//         if (strcmp (target, "USD") == 0) {
//             newvalue = money * 1.19;
//             printf("%.2f EUR is %.2f USD", money, newvalue);
//         } else if (strcmp(target, "JPY") == 0){
//             newvalue = money * 130.46;
//             printf("%.2f EUR is %.2f JPY", money, newvalue);
//         }
        
//     }
    
//     else if (strcmp(currency, "JPY") == 0){
//         if (strcmp(target, "USD") == 0){
//             newvalue = money * 0.0091;
//             printf("%.2f JPY is %.2f USD", money, newvalue);
//         } else if (strcmp(target, "EUR") == 0){
//             newvalue = money * 0.007;
//             printf("%.2f JPY is %.2f EUR", money, newvalue);
//         }
//     }
    
// }

/* ANSWER: switch case */
int main(){
    float money;
    char currency[5];
    char target[5];
    float newvalue;

    printf("Enter the amount of money: ");
    scanf("%f", &money);

    printf("Enter the original currency (USD, EUR, JPY): ");
    scanf("%3s", currency);
    
    printf("Enter the target currency exchange (USD, EUR, JPY): ");
    scanf("%3s", target);

    switch (currency[0]){
        case 'U':
            switch (target[0]){
                case 'E':
                newvalue = money * 0.84;
                printf("%.2f USD is %.2f EUR", money, newvalue);
                break;

                case 'J':
                newvalue = money * 109.81;
                printf("%.2f USD is %.2f JPY", money, newvalue);
                break;
            }

        case 'E':
            switch (target[0]){
                case 'U':
                newvalue = money * 1.19;
                printf("%.2f EUR is %.2f USD", money, newvalue);
                break;

                case 'J':
                newvalue = money * 130.46;
                printf("%.2f EUR is %.2f JPY", money, newvalue);
                break;
            }

        case 'J':
            switch (target[0]){
                case 'U':
                newvalue = money * 0.0091;
                printf("%.2f JPY is %.2f USD", money, newvalue);
                break;

                case 'E':
                newvalue = money * 0.007;
                printf("%.2f JPY is %.2f EUR", money, newvalue);
                break;
            }
    }
}