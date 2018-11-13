all: Client Server

Client: Client.c StringEncoder.o
	gcc Client.c StringEncoder.o -o Client -lm -lssl -lcrypto

Server: Server.c StringEncoder.o
	gcc Server.c StringEncoder.o -o Server -lm -lssl -lcrypto

StringEncoder.o: StringEncoder.c stringencoder.h
	gcc StringEncoder.c -c -lm -lssl

clean:
	rm -f *.o Client Server