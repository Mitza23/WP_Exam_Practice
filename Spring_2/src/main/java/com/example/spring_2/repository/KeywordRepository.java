package com.example.spring_2.repository;

import com.example.spring_2.entities.Keyword;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface KeywordRepository extends JpaRepository<Keyword, Integer> {
    public Optional<Keyword> findFirstByKey(String key);
}
