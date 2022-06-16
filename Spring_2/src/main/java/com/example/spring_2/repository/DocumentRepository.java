package com.example.spring_2.repository;

import com.example.spring_2.entities.Document;
import com.example.spring_2.entities.Template;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface DocumentRepository extends JpaRepository<Document, Integer> {

    public List<Document> findAllByTitleContaining(String title);
}
