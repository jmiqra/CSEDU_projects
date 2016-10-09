#include <windows.h>		// Header File For Windows
#include <gl\gl.h>			// Header File For The OpenGL32 Library
#include <gl\glut.h>
#include <GL/glut.h>
#include <stdio.h>
#include <stdlib.h>			// Header File For The GLu32 Library
#include<stdio.h>

float T=0, Q=0,red,blue,green;
float X=0, Y = 10, Z = 100;
int Flag=0 ,flag1=0,flag2=0,move1=0,move2=0,move3=0;
char file_name[100];
static GLubyte image[6][2048][1768][4];

//a linear array to store image data
static GLubyte linearImage[6][2048*1768*4];

//IMAGE HEIGHT AND WIDTH
unsigned int imagewidth=0, imageheight=0;

//total size of the image file
unsigned long fileSize;

//texture object number
static GLuint texName[6];

void Resize(GLsizei width, GLsizei height)		// Resize And Initialize The GL Window
{
	if (height==0)										// Prevent A Divide By Zero By
	{
		height=1;										// Making Height Equal One
	}
	glViewport(0,0,width,height);						// Reset The Current Viewport
	glMatrixMode(GL_PROJECTION);						// Select The Projection Matrix
	glLoadIdentity();									// Reset The Projection Matrix
	gluPerspective(45.0, 640.0f / 480.0f, 5, 1000);
	glMatrixMode(GL_MODELVIEW);							// Select The Modelview Matrix
	glLoadIdentity();									// Reset The Modelview Matrix
}

int loadImage(char *f_name,int index)
{
	FILE *fp;
	unsigned char blueValue, redValue, greenValue;
	unsigned int r,c;

    //opens the file
	if(!(fp = fopen(f_name, "rb")))
	{
		printf("File Open Error\n");
		return 0;
	}

	//seeking bytes from initial position
	fseek(fp,2,0);

	//reads file size
	fread(&fileSize,4,1,fp);

	//seeking bytes from initial position
	fseek(fp,18,0);

	//reading image height and width
	fread(&imagewidth,4,1,fp);
	fseek(fp,22,0);
	fread(&imageheight,4,1,fp);

	printf("%d %d\n",imagewidth,imageheight);

	//now starts data reading
	fseek(fp,54,0);

	for(r=0; r<imageheight; r++)
	{
		for(c=0; c<imagewidth; c++)
		{
			fread(&blueValue, sizeof(char), 1, fp);
			fread(&greenValue, sizeof(char), 1, fp);
			fread(&redValue , sizeof(char), 1, fp);

			image[index][r][c][0] = (GLubyte)blueValue;
			image[index][r][c][1] = (GLubyte)greenValue;
			image[index][r][c][2] = (GLubyte)redValue;
			image[index][r][c][3] = (GLubyte)255;
		}
	}
	//end of reading
	fclose(fp);
	return 1;
}

void draw_line()
{
    glBegin(GL_LINES);
    glVertex3d(0,0,0);
    glVertex3d(0,-3,0);
    glEnd();
}

void convertToLinearArray()
{
	int len;
	int index;
	for(index=0;index<6;index++)
	{
		len=0;
        for(unsigned int r=0; r<imageheight; r++)
        {
            for(unsigned int c=0; c<imagewidth; c++)
            {
                for(int k=2; k>=0;k--)
                {
                    linearImage[index][len++] = image[index][r][c][k];
                }
                linearImage[index][len++] = (GLubyte)255;
            }
        }
	}
}

void InitGL()										// All Setup For OpenGL Goes Here
{
    glClearColor(0.0f, 0.0f, 0.0f, 0.0f);
	glShadeModel(GL_SMOOTH);							// Enable Smooth Shading
    GLUquadricObj *obj1 = gluNewQuadric();
	gluQuadricNormals(obj1, GLU_SMOOTH);
	gluQuadricTexture(obj1, GL_TRUE);
	glEnable(GL_DEPTH_TEST);
    glEnable(GL_NORMALIZE);
	glEnable(GL_SMOOTH);
	glDepthFunc(GL_LEQUAL);

    convertToLinearArray();
    glPixelStorei(GL_UNPACK_ALIGNMENT,1);
	//texture object numbers
	glGenTextures(5, texName);
    for(int i=0;i<=5;i++)
    {
        glBindTexture(GL_TEXTURE_2D, texName[i]);
        glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
        glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
        glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
        glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
        glTexImage2D(GL_TEXTURE_2D,0,GL_RGBA, imagewidth, imageheight, 0, GL_RGBA, GL_UNSIGNED_BYTE,linearImage[i]);
    }
}

void draw_water()
{
    glEnable(GL_TEXTURE_2D);
    glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
    glHint(GL_PERSPECTIVE_CORRECTION_HINT, GL_NICEST);
    glBindTexture(GL_TEXTURE_2D, texName[3]);
    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-450,-30,450);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(450,-30,450);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(450,-30,-450);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-450,-30,-450);
    glEnd();
    glFlush();
    glDisable(GL_TEXTURE_2D);
}

void draw_sky()
{
    glEnable(GL_TEXTURE_2D);
    glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
    glHint(GL_PERSPECTIVE_CORRECTION_HINT, GL_NICEST);
    glBindTexture(GL_TEXTURE_2D, texName[2]);
    GLUquadricObj *obj = gluNewQuadric();
    gluQuadricDrawStyle(obj, GLU_FILL);
    gluQuadricNormals(obj, GLU_SMOOTH);
    gluQuadricTexture(obj,1);
    glPushMatrix();
    glTranslatef(0,0,-30);
    gluSphere(obj,600,50,50);
    glPopMatrix();
    glFlush();
    glDisable(GL_TEXTURE_2D);
}

void draw_window()
{
    glEnable(GL_TEXTURE_2D);
    glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
    glHint(GL_PERSPECTIVE_CORRECTION_HINT, GL_NICEST);
    glBindTexture(GL_TEXTURE_2D, texName[4]);

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(5,-11,-27.7);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(1,-11,-27);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(1 ,-13,-27);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(5,-13,-27.7);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-1,-11,-26.5);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-5,-11,-25.7);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-5,-13,-25.7);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-1,-13,-26.5);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-7,-11,-25.4);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-11,-11,-24.5);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-11,-13,-24.5);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-7,-13,-25.4);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-13,-11,-24.2);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-17,-11,-23.3);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-17,-13,-23.3);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-13,-13,-24.2);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-19,-11,-23);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-23,-11,-22.1);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-23,-13,-22.1);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-19,-13,-23);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);////
    glVertex3d(5,-11,-31.2);
    glTexCoord2f(0.0, 1.0);////
    glVertex3d(1,-11,-32);
    glTexCoord2f(1.0, 1.0);////
    glVertex3d(1 ,-13,-32);
    glTexCoord2f(1.0, 0.0);////
    glVertex3d(5,-13,-31.2);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);////
    glVertex3d(-1,-11,-32);
    glTexCoord2f(0.0, 1.0);////
    glVertex3d(-5,-11,-32.8);
    glTexCoord2f(1.0, 1.0);////
    glVertex3d(-5,-13,-32.8);
    glTexCoord2f(1.0, 0.0);////
    glVertex3d(-1,-13,-32);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);////
    glVertex3d(-7,-11,-33);
    glTexCoord2f(0.0, 1.0);////
    glVertex3d(-11,-11,-33.8);
    glTexCoord2f(1.0, 1.0);////
    glVertex3d(-11,-13,-33.8);
    glTexCoord2f(1.0, 0.0);////
    glVertex3d(-7,-13,-33);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);////
    glVertex3d(-13,-11,-33.8);
    glTexCoord2f(0.0, 1.0);////
    glVertex3d(-17,-11,-34.3);
    glTexCoord2f(1.0, 1.0);////
    glVertex3d(-17,-13,-34.3);
    glTexCoord2f(1.0, 0.0);////
    glVertex3d(-13,-13,-33.8);
    glEnd();

    glBegin(GL_POLYGON);
    glTexCoord2f(0.0, 0.0);////
    glVertex3d(-19,-11,-34.4);
    glTexCoord2f(0.0, 1.0);////
    glVertex3d(-23,-11,-35);
    glTexCoord2f(1.0, 1.0);////
    glVertex3d(-23,-13,-35);
    glTexCoord2f(1.0, 0.0);////
    glVertex3d(-19,-13,-34.4);
    glEnd();

    glFlush();
    glDisable(GL_TEXTURE_2D);
}

void drawship()
{
    glEnable(GL_TEXTURE_2D);
    glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
    glHint(GL_PERSPECTIVE_CORRECTION_HINT, GL_NICEST);
    glBindTexture(GL_TEXTURE_2D, texName[0]);

    glBegin(GL_POLYGON);       //first wall
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-28,-29,-18);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(13,-29,-22);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(14,-14,-19);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-29,-14,-13);
    glEnd();

    glBindTexture(GL_TEXTURE_2D, texName[1]);
    glBegin(GL_POLYGON);             //second wall
    glTexCoord2f(0.0, 0.0);
    glVertex3d(13,-29,-22);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(31,-27,-30);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(34,-11,-30);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(14,-14,-19);
    glEnd();

    glBegin(GL_POLYGON);      //3rd wall
    glTexCoord2f(0.0, 0.0);
    glVertex3d(31,-27,-30);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(13,-29,-38);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(14,-14,-41);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(34,-11,-30);
    glEnd();

    glBindTexture(GL_TEXTURE_2D, texName[0]);
    glBegin(GL_POLYGON); //4th wall
    glTexCoord2f(0.0, 0.0);
    glVertex3d(13,-29,-38);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-28,-29,-42);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-29,-14,-45);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(14,-14,-41);
    glEnd();

    glBindTexture(GL_TEXTURE_2D, texName[1]);
    glBegin(GL_POLYGON); //5th wall
    glTexCoord2f(0.0, 0.0);
    glVertex3d(-28,-29,-42);
    glTexCoord2f(1.0, 0.0);
    glVertex3d(-28,-29,-18);
    glTexCoord2f(1.0, 1.0);
    glVertex3d(-29,-14,-13);
    glTexCoord2f(0.0, 1.0);
    glVertex3d(-29,-14,-45);
    glEnd();

    glFlush();
    glDisable(GL_TEXTURE_2D);
}

void DrawGLScene()									// Here's Where We Do All The Drawing
{
	glEnable(GL_DEPTH_TEST);
	glClear(GL_COLOR_BUFFER_BIT|GL_DEPTH_BUFFER_BIT);
	glLoadIdentity();
//	glPushMatrix();
	//glLoadIdentity();
    gluLookAt(X,Y,Z,0,0,-30,0,1,0);
    glPushMatrix();
    glTranslatef(0,0,-100);
    //another_ship();
    glPopMatrix();
    draw_sky();
    //DrawQuads();
    draw_water();
    glPushMatrix();
    glTranslatef(move1,0,move3);
    draw_window();
    drawship();
    //glColor3d(0.75,.45,0.2);   //for upper quads
    glColor3d(0.5,0.3,0.2);
    glBegin(GL_POLYGON);
    glVertex3d(14,-14,-19);
    glVertex3d(-29,-14,-13);
    glVertex3d(-29,-14,-14);
    glVertex3d(14,-14,-20);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-29,-14,-14);
    glVertex3d(14,-14,-20);
    glVertex3d(14,-16,-20);
    glVertex3d(-29,-16,-14);
    glEnd();
    //for 2nd upper quads
    glBegin(GL_POLYGON);
    glVertex3d(34,-11,-30);
    glVertex3d(14,-14,-19);
    glVertex3d(14,-14,-20);
    glVertex3d(32,-11,-30);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(14,-14,-20);
    glVertex3d(32,-11,-30);
    glVertex3d(30,-13,-30);
    glVertex3d(14,-16,-20);
    glEnd();
    //for 3rd upper quads
    glBegin(GL_POLYGON);
    glVertex3d(14,-14,-41);
    glVertex3d(34,-11,-30);
    glVertex3d(32,-11,-30);
    glVertex3d(14,-14,-40);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(32,-11,-30);
    glVertex3d(14,-14,-40);
    glVertex3d(14,-16,-40);
    glVertex3d(30,-13,-30);
    glEnd();
    //for 4th upper quads
    glBegin(GL_POLYGON);
    glVertex3d(-29,-14,-45);
    glVertex3d(14,-14,-41);
    glVertex3d(14,-14,-40);
    glVertex3d(-29,-14,-44);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(14,-14,-40);
    glVertex3d(-29,-14,-44);
    glVertex3d(-29,-16,-44);
    glVertex3d(14,-16,-40);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-29,-14,-13);
    glVertex3d(-29,-14,-45);
    glVertex3d(-28,-14,-45);
    glVertex3d(-28,-14,-13);
    glEnd();


    glColor3d(0.63,0.32,0.18);
    glBegin(GL_POLYGON);
    glVertex3d(-28,-14,-45);
    glVertex3d(-28,-14,-13);
    glVertex3d(-28,-16,-14);
    glVertex3d(-28,-16,-44);
    glEnd();


    glColor3d(1,0.8,0.5);  //pataton
    glBegin(GL_POLYGON);
    glVertex3d(14,-16,-20);
    glVertex3d(34,-13,-30);
    glVertex3d(14,-16,-40);
    glEnd();

    glColor3d(1.0,0.6,0.5);  //pataton
    glBegin(GL_POLYGON);
    glVertex3d(14,-16,-20);
    glVertex3d(14,-16,-40);
    glVertex3d(12,-20,-40);
    glVertex3d(12,-20,-20);
    glEnd();

    glColor3d(0.5,0.3,0.2);    //pataton
    glBegin(GL_POLYGON);
    glVertex3d(12,-20,-39);
    glVertex3d(12,-20,-21);
    glVertex3d(-28,-20,-15);
    glVertex3d(-28,-20,-43);
    glEnd();

    //glColor3d(1.0,0.0,0.0);
    glColor3d(1.0,0.8,0.6);  //basement of the ship
    glBegin(GL_POLYGON);
    glVertex3d(10,-14,-37);
    glVertex3d(10,-14,-23);
    glVertex3d(-27,-14,-17);
    glVertex3d(-27,-14,-41);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(10,-14,-37);
    glVertex3d(10,-14,-23);
    glVertex3d(10,-20,-23);
    glVertex3d(10,-20,-37);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-27,-14,-41);
    glVertex3d(-27,-14,-17);
    glVertex3d(-27,-20,-17);
    glVertex3d(-27,-20,-41);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-27,-14,-17);
    glVertex3d(10,-14,-23);
    glVertex3d(10,-20,-23);
    glVertex3d(-27,-20,-17);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-27,-14,-41);
    glVertex3d(10,-14,-37);
    glVertex3d(10,-20,-37);
    glVertex3d(-27,-20,-41);
    glEnd();

    glColor3d(0.72,0.22,0.12);////// cabin top
    glBegin(GL_POLYGON);
    glVertex3d(6,-10,-31);
    glVertex3d(6,-10,-28);
    glVertex3d(-24,-10,-22);
    glVertex3d(-24,-10,-35);
    glEnd();

    glColor3d(0.8,0.3,0.2);//// cabin sides
    glBegin(GL_POLYGON);
    glVertex3d(6,-10,-31);
    glVertex3d(6,-10,-28);
    glVertex3d(6,-14,-28);
    glVertex3d(6,-14,-31);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(-24,-10,-22);
    glVertex3d(-24,-10,-35);
    glVertex3d(-24,-14,-35);
    glVertex3d(-24,-14,-22);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(6,-10,-28);
    glVertex3d(-24,-10,-22);
    glVertex3d(-24 ,-14,-22);
    glVertex3d(6,-14,-28);
    glEnd();

    glBegin(GL_POLYGON);
    glVertex3d(6,-10,-31);
    glVertex3d(-24,-10,-35);
    glVertex3d(-24 ,-14,-35);
    glVertex3d(6,-14,-31);
    glEnd();

    glBegin(GL_TRIANGLES);// red triangle // back design
    glColor3f(0.5f,0.0f,0.0f);
    glVertex3d(-28.5,-20,-36);
    glVertex3d(-28.5,-20,-24);
    glVertex3d(-29,-25,-30);
    glEnd();

    glBegin(GL_POLYGON);//flag
    glColor3f(0.0f,0.0f,0.0f);
    glVertex3d(-9.5,41,-30);
    glVertex3d(-9.5,48,-30);
    glVertex3d(0.5,48,-30);
    glVertex3d(0.5,41,-30);
    glEnd();

    glBegin(GL_LINES);
    glColor3f(1.0f,1.0f,1.0f);
    glVertex3d(0.5,41,-29.5);
    glVertex3d(-9.5,48,-29.5);
    glEnd();

    glBegin(GL_LINES);
    glColor3f(1.0f,1.0f,1.0f);
    glVertex3d(-9,41,-29.5);
    glVertex3d(0.5,48,-29.5);
    glEnd();

    glBegin(GL_LINES);
    glColor3f(1.0f,1.0f,1.0f);
    glVertex3d(0.5,41,-30.5);
    glVertex3d(-9.5,48,-30.5);
    glEnd();

    glBegin(GL_LINES);
    glColor3f(1.0f,1.0f,1.0f);
    glVertex3d(-9,41,-30.5);
    glVertex3d(0.5,48,-30.5);
    glEnd();

    glBegin(GL_TRIANGLE_FAN);//pal boro
    glColor3f(1.0f,0.9f,0.9f);
    glVertex3d(-8,38,-30);
    glVertex3d(38,-3,-30);
    glVertex3d(-8,-8,-30);
    glEnd();

    glBegin(GL_TRIANGLE_FAN);//pal boro
    glColor3f(1.0f,0.9f,0.9f);
    glVertex3d(-12,38,-30);
    glVertex3d(-25,-3,-30);
    glVertex3d(-12,-8,-30);
    glEnd();

    glBegin(GL_TRIANGLE_FAN);//pal choto
    glColor3f(1.0f,0.8f,0.8f);
    glVertex3d(-5,32,-28);
    glVertex3d(37,-3,-30);
    glVertex3d(0,0,-28);
    glEnd();

    glBegin(GL_TRIANGLE_FAN);//pal chotoest
    glColor3f(1.0f,0.7f,0.7f);
    glVertex3d(-3,28,-27);
    glVertex3d(37,-3,-30);
    glVertex3d(5,5,-27);
    glEnd();

    glColor3f(.74,.74,.74);
    glBegin(GL_POLYGON);
    GLUquadricObj *obj = gluNewQuadric();
    glEnd();

    glPushMatrix();
    glTranslatef(-19.5,2,-28);
    glRotatef(90,1,0,0);
    gluCylinder(obj, 2, 2, 12, 30, 30);
    glPopMatrix();

    glColor3f(.62,.62,.62);
    glPushMatrix();
    glTranslatef(-14.5,0,-28);
    glRotatef(90,1,0,0);
    gluCylinder(obj, 2, 2, 10, 30, 30);
    glPopMatrix();

    glColor3f(.3,.3,.3);// stick
    glPushMatrix();
    glTranslatef(-22,15,-25);
    glRotatef(90,1,0,0);
    gluCylinder(obj, 0.5, 0.5, 25, 30, 30);
    glPopMatrix();

    glColor3f(.4,0.2,0.1);// stick pal boro
    glPushMatrix();
    glTranslatef(-10,48,-30);
    glRotatef(90,1,0,0);
    gluCylinder(obj, 0.5, 0.5, 58, 30, 30);
    glPopMatrix();

    glColor3f(.5,0.3,0.2);// stick pal choto
    glPushMatrix();
    glTranslatef(-6,33,-28);
    glRotatef(90,1,0,0);
    gluCylinder(obj, 0.5, 0.5, 43, 30, 28);
    glPopMatrix();

    glPointSize(50);

    glColor3d(0,0,0);  //relling

    glBegin(GL_LINES); //pal left
    glVertex3d(-10,40,-30);
    glVertex3d(-12.5,36,-30);
    glEnd();

    glBegin(GL_LINES);//pal left
    glVertex3d(-10,-10,-30);
    glVertex3d(-12.5,-7.5,-30);
    glEnd();

    glBegin(GL_LINES);//pal left
    glVertex3d(-29,-15,-30);
    glVertex3d(-25,-2.5,-30);
    glEnd();

    glBegin(GL_LINES); //pal
    glVertex3d(-10,40,-30);
    glVertex3d(-7.5,37.5,-30);
    glEnd();

    glBegin(GL_LINES);//pal
    glVertex3d(-10,-10,-30);
    glVertex3d(-7.5,-7.5,-30);
    glEnd();

    glBegin(GL_LINES);//pal
    glVertex3d(38,-3,-30);
    glVertex3d(34,-8,-30);
    glEnd();

    glBegin(GL_LINES);//pal choto
    glVertex3d(-5,32,-28);
    glVertex3d(-6,33,-28);
    glEnd();

    glBegin(GL_LINES);//pal choto
    glVertex3d(-6,-10,-28);
    glVertex3d(0,0,-28);
    glEnd();

    glBegin(GL_LINES);//pal chotoest
    glVertex3d(-2.5,27.5,-27);
    glVertex3d(-6,33,-28);
    glEnd();

    glBegin(GL_LINES);//pal chotoest
    glVertex3d(-6,-10,-28);
    glVertex3d(5,5,-27);
    glEnd();

    glBegin(GL_LINES);
    glVertex3d(34,-8,-30);
    glVertex3d(14,-11,-20);
    glEnd();

    glBegin(GL_LINES);
    glVertex3d(34,-8,-30);
    glVertex3d(34,-11,-30);
    glEnd();

    glBegin(GL_LINES);
    glVertex3d(14,-11,-20);
    glVertex3d(14,-14,-20);
    glEnd();

    glBegin(GL_LINES);
    glVertex3d(34,-8,-30);
    glVertex3d(14,-11,-40);
    glEnd();

    glBegin(GL_LINES);
    glVertex3d(14,-11,-40);
    glVertex3d(14,-14,-40);
    glEnd();

    glPushMatrix();
    glTranslatef(19,-10.25,-22.5);
    draw_line();
    glPopMatrix();
    glPushMatrix();
    glTranslatef(19,-10.25,-37.5);
    draw_line();
    glPopMatrix();
    glPushMatrix();
    glTranslatef(24,-9.5,-25);
    draw_line();
    glPopMatrix();
    glPushMatrix();
    glTranslatef(24,-9.5,-35);
    draw_line();
    glPopMatrix();
    glPushMatrix();
    glTranslatef(29,-8.75,-27.5);
    draw_line();
    glPopMatrix();
    glPushMatrix();
    glTranslatef(29,-8.75,-32.5);
    draw_line();
    glPopMatrix();
    glPopMatrix();
	glutSwapBuffers();
}

void handleKeypress(unsigned char key, int x, int y)
{
	switch (key)
	{
		case 27: //Escape key
			exit(0);

        case 'a':case 'A':
        {
            Z=Z-5;
            gluLookAt(0,0,Z,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 's':case 'S':
        {
            Z=Z+5;
            gluLookAt(0,0,Z,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 'v':case 'V':
        {
            Y=Y+5;
            gluLookAt(0,Y,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 'c':case 'C':
        {
           Y=Y-5;
            gluLookAt(0,Y,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 'x':case 'X':
        {
           X=X-5;
            gluLookAt(X,0,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 'z':case 'Z':
        {
           X=X+5;
            gluLookAt(X,0,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }
//////////////////////////////////////////////////////new type projection test
        case 'n':case 'N':
        {
           X=X-5;
           Y=Y-5;
            gluLookAt(X,Y,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }

        case 'm':case 'M':
        {
           X=X+5;
           Y=Y+5;
            gluLookAt(X,Y,0,0,0,0,0,1,0);
            glutPostRedisplay();
            break;
        }
    }
}

void handleSpecialKeypress(int key, int x, int y)
{
    switch (key)
    {
        case GLUT_KEY_LEFT :
        {
           move1=move1-1;
           glutPostRedisplay();
           break;
        }

        case GLUT_KEY_RIGHT :
        {
           move1=move1+1;
           glutPostRedisplay();
           break;
        }

        case GLUT_KEY_UP :
        {
           move3=move3-1;
           glutPostRedisplay();
           break;
        }

        case GLUT_KEY_DOWN :
        {
            move3=move3+1;
            glutPostRedisplay();
            break;
        }
    }
}

int  main(int argc, char *argv[])
{
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_RGB | GLUT_DOUBLE | GLUT_DEPTH);
	//pic0
	//opening file with filename
	PlaySound("pirate.wav", NULL, SND_ASYNC|SND_FILENAME|SND_LOOP);
	strcpy(file_name, "wood.bmp");
	//loading image file
	if(!loadImage(file_name,0))
	{
		printf("\n0File Error\n");
		return 0;
	}
	//pic1
	//opening file with filename
	strcpy(file_name, "wood1.bmp");
	//loading image file
	if(!loadImage(file_name,1))
	{
		printf("\n1 File Error\n");
		return 0;
	}
	//pic2
	//opening file with filename
	strcpy(file_name, "sky.bmp");
	//loading image file
	if(!loadImage(file_name,2))
	{
		printf("\n2 File Error\n");
		return 0;
	}
	strcpy(file_name, "sea.bmp");
	//loading image file
	if(!loadImage(file_name,3))
	{
		printf("\n3 File Error\n");
		return 0;
	}
	strcpy(file_name, "window.bmp");
	//loading image file
	if(!loadImage(file_name,4))
	{
		printf("\n4 File Error\n");
		return 0;
	}

    glutInitWindowSize(640,480);
    glutInitWindowPosition(10,10);
    glutCreateWindow("Pirate Ship");
    InitGL();
    glutDisplayFunc(DrawGLScene);
    glutReshapeFunc(Resize);
    glutKeyboardFunc(handleKeypress);
    glutSpecialFunc(handleSpecialKeypress);

    glClearColor(0.0,0.0,0.0,0.0);

    glutMainLoop();

    return 0;
}
