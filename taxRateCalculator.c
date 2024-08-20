/* Write a program that includes a function, as specified in the minimum requirements, that takes two double precision floating-point arguments - taxedAmount and originalAmount. It calculates the effective tax rate using the provided data. For example, if the taxed amount is 100 and the original amount is 1000, the tax rate would be 10%. Finally, the function will return the result of the calculation in double data type. In the main function, ask for the taxedAmount and originalAmount inputs, then call the created function using the inputs, get the returned value, and print the said value.
*/

/*
    Expected Output 1:
        Enter the taxed amount: 500.55
        Enter the original amount: 50000.55
        Effective Tax Rate: 1.00%

    Expected Output 2:
        Enter the taxed amount: 5.55
        Enter the original amount: 100.23
        Effective Tax Rate: 5.54%
*/


#include <stdio.h>

double effectiveTaxRate (double, double);

int main (){
    double taxedAmount, originalAmount;

    printf("Enter the taxed amount: ");
    scanf("%lf", &taxedAmount);

    printf("Enter the original amount: ");
    scanf("%lf", &originalAmount);

    double eTaxRate = effectiveTaxRate (taxedAmount, originalAmount);

    printf("Effective Tax Rate: %.2lf%%", eTaxRate);

}

double effectiveTaxRate (double taxedAmount, double originalAmount){
    double eTaxRate;

    eTaxRate = taxedAmount/originalAmount * 100;

    return eTaxRate;
}