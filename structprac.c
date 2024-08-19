#include <stdio.h>
#define SIZE 10

typedef struct {
    char LName[16];
    char FName[24];
    char Mi;
}Nametype;

typedef struct {
    Nametype name;
    unsigned int ID;
    char Course[8];
    int YrLevel;
}Studtype;

Studtype displayStudent (Studtype S);

int main (){
    Studtype stud [ ] = { {{"Ando","Jude", 'M'}, 11111, "BSCS", 1},
                         {{"Auza","Marco", 'C'}, 22222, "BSCS", 1},
                         {{"Tibon","Hestia", 'L'}, 33333, "BSCS", 1},
                         {{"Medina","Karl", 'E'}, 44444, "BSIT", 1},
                       };
    
    int num = sizeof(stud)/sizeof(stud[0]);
    int i;
    
    for(i = 0; i < num; i++) { 
        displayStudent(stud[i]); 
    }
}

Studtype displayStudent (Studtype S){ 
    printf("\n%-10d",S.ID);
    printf("%-16s",S.name.LName);
    printf("%-16s",S.name.FName);
    printf("%-5c",S.name.Mi);
    printf("%-10s",S.Course);
    printf("%5d",S.YrLevel);
}

