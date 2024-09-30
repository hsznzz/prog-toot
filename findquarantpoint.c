#include <stdio.h>

typedef struct{
    int x;
    int y;
}axis;

int identifyPoint(axis p);
int display(axis p, int rnum);

int main(){
    axis p;
    int rnum;
    
    printf("Enter x - coordinate: ");
    scanf("%d", &p.x);
    printf("Enter y - coordinate: ");
    scanf("%d", &p.y);
    
    rnum = identifyPoint(p);
    display(p, rnum);
}

int identifyPoint(axis p){
    if (p.x == 0 && p.y == 0){
        return 0;
    } else if (p.x > 0 && p.y > 0){
        return 1;
    } else if (p.x < 0 && p.y > 0){
        return 2;
    } else if (p.x < 0 && p.y < 0){
        return 3;
    } else if (p.x > 0 && p.y < 0){
        return 4;
    } else if (p.x > 0 && p.y == 0 || p.x < 0 && p.y == 0 ){
        return 5;
    } else if (p.x == 0 && p.y > 0 || p.x == 0 && p.y < 0){
        return 6;
    }
    
}

int display(axis p, int rnum){
    switch (rnum){
        case 0:
        printf("The point (%d, %d) is in Origin.", p.x, p.y);
        break;
        
        case 1:
        printf("The point (%d, %d) is in Q1.", p.x, p.y);
        break;
        
        case 2:
        printf("The point (%d, %d) is in Q2.", p.x, p.y);
        break;
        
        case 3:
        printf("The point (%d, %d) is in Q3.", p.x, p.y);
        break;
        
        case 4:
        printf("The point (%d, %d) is in Q4.", p.x, p.y);
        break;
        
        case 5:
        printf("The point (%d, %d) is in x-axis.", p.x, p.y);
        break;
        
        case 6:
        printf("The point (%d, %d) is in y-axis.", p.x, p.y);
        break;
    }
}