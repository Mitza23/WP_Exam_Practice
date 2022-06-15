package com.example.spring.repository;

import com.example.spring.entities.Project;
import com.example.spring.entities.ProjectName;
import org.springframework.data.domain.Sort;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Optional;

@Repository
public interface ProjectRepository extends JpaRepository<Project, Integer> {

    List<ProjectName> findAllByMembersContaining(String name);

    Optional<Project> findByName(String name);
}
