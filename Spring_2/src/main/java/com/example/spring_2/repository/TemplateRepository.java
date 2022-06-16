package com.example.spring_2.repository;

import com.example.spring_2.entities.Template;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface TemplateRepository extends JpaRepository<Template, Integer> {
    public Optional<Template> findFirstByName(String name);
}
