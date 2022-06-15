package com.example.spring.repository;

import com.example.spring.entities.SoftwareDeveloper;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface DeveloperRepository extends JpaRepository<SoftwareDeveloper, Integer> {
    public Optional<SoftwareDeveloper> findFirstByName(String name);

    Optional<SoftwareDeveloper> findByName(String name);
}
