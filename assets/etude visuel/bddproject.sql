#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Table: CATEGORY
#------------------------------------------------------------

CREATE TABLE CATEGORY(
        CATEGORY_ID   Int  Auto_increment  NOT NULL ,
        CATEGORY_NAME Char (20) NOT NULL
	,CONSTRAINT CATEGORY_PK PRIMARY KEY (CATEGORY_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: STATUS
#------------------------------------------------------------

CREATE TABLE STATUS(
        STATUS_ID   Int  Auto_increment  NOT NULL ,
        STATUS_NAME Char (10) NOT NULL
	,CONSTRAINT STATUS_PK PRIMARY KEY (STATUS_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: USER
#------------------------------------------------------------

CREATE TABLE USER(
        USER_ID       Int  Auto_increment  NOT NULL ,
        USER_FIRSNAME Char (20) NOT NULL ,
        USER_LASTNAME Char (20) NOT NULL ,
        USER_EMAIL    Varchar (20) NOT NULL ,
        USER_CITY     Char (20) NOT NULL ,
        USER_ZIPCODE  Int NOT NULL ,
        USER_PASSWORD Varchar (20) NOT NULL ,
        STATUS_ID     Int NOT NULL
	,CONSTRAINT USER_PK PRIMARY KEY (USER_ID)

	,CONSTRAINT USER_STATUS_FK FOREIGN KEY (STATUS_ID) REFERENCES STATUS(STATUS_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CONDITION
#------------------------------------------------------------

CREATE TABLE CONDITIONARTICLE(
        CONDITION_ID   Int  Auto_increment  NOT NULL ,
        CONDITION_NAME Char (20) NOT NULL
	,CONSTRAINT CONDITION_PK PRIMARY KEY (CONDITION_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ARTICLE
#------------------------------------------------------------

CREATE TABLE ARTICLE(
        ARTICLE_ID           Int  Auto_increment  NOT NULL ,
        ARTICLE_TITLE        Char (25) NOT NULL ,
        ARTICLE_QUANTITY     Int NOT NULL ,
        ARTICLE_PURCHASEDATE Datetime NOT NULL ,
        ARTICLE_PRICE        Int NOT NULL ,
        ARTICLE_GIVE         Bool NOT NULL ,
        ARTICLE_DESCRIPTION  Varchar (170) NOT NULL ,
        USER_ID              Int NOT NULL ,
        CATEGORY_ID          Int NOT NULL ,
        CONDITION_ID         Int NOT NULL
	,CONSTRAINT ARTICLE_PK PRIMARY KEY (ARTICLE_ID)

	,CONSTRAINT ARTICLE_USER_FK FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID)
	,CONSTRAINT ARTICLE_CATEGORY0_FK FOREIGN KEY (CATEGORY_ID) REFERENCES CATEGORY(CATEGORY_ID)
	,CONSTRAINT ARTICLE_CONDITION1_FK FOREIGN KEY (CONDITION_ID) REFERENCES CONDITIONARTICLE(CONDITION_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CONVERSATION
#------------------------------------------------------------

CREATE TABLE CONVERSATION(
        CONVERSATION_ID   Int  Auto_increment  NOT NULL ,
        CONVERSATION_TEXT Varchar (100) NOT NULL ,
        ARTICLE_ID        Int NOT NULL
	,CONSTRAINT CONVERSATION_PK PRIMARY KEY (CONVERSATION_ID)

	,CONSTRAINT CONVERSATION_ARTICLE_FK FOREIGN KEY (ARTICLE_ID) REFERENCES ARTICLE(ARTICLE_ID)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relation5
#------------------------------------------------------------

CREATE TABLE relation5(
        CONVERSATION_ID Int NOT NULL ,
        USER_ID         Int NOT NULL
	,CONSTRAINT relation5_PK PRIMARY KEY (CONVERSATION_ID,USER_ID)

	,CONSTRAINT relation5_CONVERSATION_FK FOREIGN KEY (CONVERSATION_ID) REFERENCES CONVERSATION(CONVERSATION_ID)
	,CONSTRAINT relation5_USER0_FK FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID)
)ENGINE=InnoDB;

