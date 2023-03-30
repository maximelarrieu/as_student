#include <stdio.h>
#include <stdlib.h>
int main() {
    char str[] = "fzmxfcjaan kmdixdkz\n";
    int index = 0;

    while(str[index] != '\0') {
        if(str[index] >= 97 && str[index] <= 122) {
            str[index] -= 5;
        }
        index++;
    }
    printf(str);
    return 0;
}