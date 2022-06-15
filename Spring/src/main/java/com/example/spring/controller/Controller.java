package com.example.spring.controller;

import com.example.spring.entities.Project;
import com.example.spring.entities.ProjectName;
import com.example.spring.service.Service;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api")
public class Controller {

    @Autowired
    Service service;

    @GetMapping
    List<Project> getAll() {
        return service.findAll();
    }

    @GetMapping(path ="/personal")
    List<ProjectName> getPersonal(@RequestParam String name) {
        return service.findProjectsOfUser(name);
    }

    @PostMapping
    void addProjects(@RequestParam String devName, @RequestParam List<String> projects){
        service.addDeveloperToProjects(devName, projects);
    }
}
