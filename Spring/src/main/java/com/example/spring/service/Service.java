package com.example.spring.service;

import com.example.spring.entities.Project;
import com.example.spring.entities.ProjectName;
import com.example.spring.entities.SoftwareDeveloper;
import com.example.spring.repository.DeveloperRepository;
import com.example.spring.repository.ProjectRepository;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.List;
import java.util.Optional;

@org.springframework.stereotype.Service
public class Service {
    @Autowired
    DeveloperRepository developerRepository;

    @Autowired
    ProjectRepository projectRepository;

    public int checkUsername(String name) {
         Optional<SoftwareDeveloper> optional = developerRepository.findFirstByName(name);
        return optional.isEmpty() ? -1 : optional.get().getId();
    }

    public List<ProjectName> findProjectsOfUser(String name) {
        return projectRepository.findAllByMembersContaining(name);
    }

    public List<Project> findAll() {
        return projectRepository.findAll();
    }

    public void addDeveloperToProjects(String devName, List<String> projects) {
        Optional<SoftwareDeveloper> optional = developerRepository.findByName(devName);
        if(optional.isPresent()){
            projects.forEach(project -> {
                Optional<Project> optionalProject = projectRepository.findByName(project);
                Project p;
                if(optionalProject.isEmpty()){
                    p = new Project(project);
                }
                else {
                    p = optionalProject.get();
                }
                p.addMember(devName);
                projectRepository.save(p);
            });
        }
    }
}
