#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: t_member
#------------------------------------------------------------

CREATE TABLE t_member(
        idMember     int (11) Auto_increment  NOT NULL ,
        memPseudo    Varchar (30) NOT NULL ,
        memMail      Varchar (60) NOT NULL ,
        memEnterDate Date NOT NULL ,
        memPassword  Varchar (60) NOT NULL ,
        memVarious   Varchar (600) ,
        idGrade      Int NOT NULL ,
        PRIMARY KEY (idMember )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: t_grade
#------------------------------------------------------------

CREATE TABLE t_grade(
        idGrade          int (11) Auto_increment  NOT NULL ,
        graName          Varchar (30) NOT NULL ,
        graDescription   Varchar (120) ,
        graAccreditation Int NOT NULL ,
        PRIMARY KEY (idGrade )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: t_function
#------------------------------------------------------------

CREATE TABLE t_function(
        idFunction       int (11) Auto_increment  NOT NULL ,
        funName          Varchar (60) NOT NULL ,
        funDescription   Varchar (120) NOT NULL ,
        funAccreditation Int NOT NULL ,
        PRIMARY KEY (idFunction )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: t_subject
#------------------------------------------------------------

CREATE TABLE t_subject(
        idSubject int (11) Auto_increment  NOT NULL ,
        subTitle  Varchar (60) NOT NULL ,
        idMember  Int NOT NULL ,
        idForum   Int NOT NULL ,
        PRIMARY KEY (idSubject )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: t_post
#------------------------------------------------------------

CREATE TABLE t_post(
        idPost    int (11) Auto_increment  NOT NULL ,
        posText   Longtext NOT NULL ,
        idMember  Int NOT NULL ,
        idSubject Int NOT NULL ,
        PRIMARY KEY (idPost )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: t_forum
#------------------------------------------------------------

CREATE TABLE t_forum(
        idForum          int (11) Auto_increment  NOT NULL ,
        forName          Varchar (30) NOT NULL ,
        forAddiction     Int NOT NULL ,
        forDescription   Varchar (120) NOT NULL ,
        forAccreditation Int NOT NULL ,
        PRIMARY KEY (idForum )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Have
#------------------------------------------------------------

CREATE TABLE Have(
        idMember   Int NOT NULL ,
        idFunction Int NOT NULL ,
        PRIMARY KEY (idMember ,idFunction )
)ENGINE=InnoDB;

ALTER TABLE t_member ADD CONSTRAINT FK_t_member_idGrade FOREIGN KEY (idGrade) REFERENCES t_grade(idGrade);
ALTER TABLE t_subject ADD CONSTRAINT FK_t_subject_idMember FOREIGN KEY (idMember) REFERENCES t_member(idMember);
ALTER TABLE t_subject ADD CONSTRAINT FK_t_subject_idForum FOREIGN KEY (idForum) REFERENCES t_forum(idForum);
ALTER TABLE t_post ADD CONSTRAINT FK_t_post_idMember FOREIGN KEY (idMember) REFERENCES t_member(idMember);
ALTER TABLE t_post ADD CONSTRAINT FK_t_post_idSubject FOREIGN KEY (idSubject) REFERENCES t_subject(idSubject);
ALTER TABLE Have ADD CONSTRAINT FK_Have_idMember FOREIGN KEY (idMember) REFERENCES t_member(idMember);
ALTER TABLE Have ADD CONSTRAINT FK_Have_idFunction FOREIGN KEY (idFunction) REFERENCES t_function(idFunction);
