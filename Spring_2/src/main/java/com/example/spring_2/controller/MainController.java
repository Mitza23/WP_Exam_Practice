package com.example.spring_2.controller;

import com.example.spring_2.entities.Document;
import com.example.spring_2.entities.Keyword;
import com.example.spring_2.entities.KeywordDTO;
import com.example.spring_2.service.Service;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@CrossOrigin(origins = "*", methods = {RequestMethod.DELETE, RequestMethod.GET, RequestMethod.POST, RequestMethod.PUT })
@RestController
@RequestMapping("/api")
public class MainController {
    @Autowired
    Service service;

    @PostMapping
    public void addKeyword(@RequestBody KeywordDTO keywordDTO) {
        service.addKeyword(new Keyword(keywordDTO.key, keywordDTO.value));
    }

    @GetMapping
    public List<Document> getDocuments(@RequestParam String title) {
        return service.findAllByTitle(title);
    }

    @PostMapping("/document")
    public String getDocument(@RequestBody Document document) {
        return service.generateDocument(document);
    }
}
