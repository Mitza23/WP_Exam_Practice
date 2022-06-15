package com.example.spring.entities;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import javax.persistence.*;

@Entity
@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
public class Project {
    @Id
    @Column(name = "id", nullable = false)
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    private Integer projectManagerId;

    private String name;

    private String description;

    private String members;

    public Project(String name) {
        this.name = name;
        this.members = "";
    }

    public void addMember(String member) {
        this.members += member;
    }
}
