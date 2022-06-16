package com.example.spring_2.service;

import com.example.spring_2.entities.Document;
import com.example.spring_2.entities.Keyword;
import com.example.spring_2.entities.Template;
import com.example.spring_2.repository.DocumentRepository;
import com.example.spring_2.repository.KeywordRepository;
import com.example.spring_2.repository.TemplateRepository;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.Arrays;
import java.util.List;
import java.util.Optional;

@org.springframework.stereotype.Service
public class Service {
    @Autowired
    DocumentRepository documentRepository;

    @Autowired
    KeywordRepository keywordRepository;

    @Autowired
    TemplateRepository templateRepository;

    public void addKeyword(Keyword keyword) {
        keywordRepository.save(keyword);
    }

    public List<Document> findAllByTitle(String title) {
        return documentRepository.findAllByTitleContaining(title);
    }

    public String generateTemplate(String template) {
        StringBuffer result = new StringBuffer();
        Arrays.stream(template.split(" "))
                .forEach(word -> {
                    if(word.matches("^\\{\\{.+}}$")){
                        int len = word.length();
                        word = word.substring(2, len - 2);
                        Optional<Keyword> optional = keywordRepository.findFirstByKey(word);
                        optional.ifPresent(value -> result.append(value.getValue()));
//                        result.append(keywordRepository.findFirstByKey(word).get().getValue());
                    }
                    else {
                        result.append(word);
                    }
                    result.append(" ");
                });
        return result.toString();
    }

    public String generateDocument(Document document) {
        StringBuffer result = new StringBuffer();
        Arrays.stream(document.getListOfTemplates().split(" "))
                .forEach(template -> {
                    Optional<Template> optional = templateRepository.findFirstByName(template);
                    optional.ifPresent(value -> result.append(template)
                            .append("\n")
                            .append(generateTemplate(value.getTextContent()))
                            .append("\n"));
                });
        return result.toString();
    }
}
