#ifndef StringEncoder_h
#define StringEncoder_h

class StringEncoded{
private:
    int binaryMap[8];
public:
    void inplace_reverse(char*);
    int binaryToDecimal(long);
    long decimalToBinary(long);
    void stringToAscii(char*);
    void stringToReverseAscii(char*);
    char* stringToEncodedAscii(char*){
};

#endif /* StringEncoder_h */
