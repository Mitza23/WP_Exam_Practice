using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using MySql.Data.MySqlClient;
using documents_NET.Models;

namespace documents_NET.DataAbstractionLayer
{
    public class DAL
    {
        private MySqlConnection connection = new MySqlConnection("server=localhost;database=documents_db;uid=root;");

        public List<Document> GetDocuments()
        {
            List<Document> documentsList = new List<Document>();

            try
            {
                connection.Open();

                MySqlCommand command = new MySqlCommand();
                command.Connection = connection;
                command.CommandText = "SELECT * FROM documents";

                MySqlDataReader myReader = command.ExecuteReader();

                while (myReader.Read())
                {
                    Document document = new Document();
                    document.id = myReader.GetInt32("id");
                    document.title = myReader.GetString("title");

                    string templates = myReader.GetString("templates");
                    document.templates = templates.Split(',');


                    documentsList.Add(document);
                }
                myReader.Close();
            }
            catch (Exception ex)
            {
                System.Diagnostics.Debug.WriteLine(ex.Message);
            }
            return documentsList;

        }

        public List<Document> FilterByTitle(string title)
        {
            List<Document> documentsList = new List<Document>();

            try
            {
                connection.Open();

                MySqlCommand command = new MySqlCommand();
                command.Connection = connection;
                command.CommandText = "SELECT * FROM documents WHERE title LIKE '%" + title + "%'";

                MySqlDataReader myReader = command.ExecuteReader();

                while (myReader.Read())
                {
                    Document document = new Document();
                    document.id = myReader.GetInt32("id");
                    document.title = myReader.GetString("title");

                    string templates = myReader.GetString("templates");
                    document.templates = templates.Split(',');


                    documentsList.Add(document);
                }
                myReader.Close();
            }
            catch (Exception ex)
            {
                System.Diagnostics.Debug.WriteLine(ex.Message);
            }
            return documentsList;

        }


        public bool Add(string key, string value)
        {
            try
            {
                connection.Open();

                MySqlCommand command = new MySqlCommand();
                command.Connection = connection;
                command.CommandText = "INSERT INTO keywords(kkey, value) VALUES (@key, @Value)";

                command.Parameters.AddWithValue("@Key", key);
                command.Parameters.AddWithValue("@Value", value);

                int result = command.ExecuteNonQuery();
                connection.Close();
                return result == 1;

            }
            catch (MySqlException ex)
            {
                System.Diagnostics.Debug.WriteLine(ex.Message);
            }

            return false;
        }


        public string GetGeneratedDocument(int documentId)
        {

            string generatedDocument = "";
            try
            {
                connection.Open();

                MySqlCommand command = new MySqlCommand();
                command.Connection = connection;
                command.CommandText = "SELECT * FROM documents WHERE id = @DocumentId ";
                command.Parameters.AddWithValue("@DocumentId", documentId);

                MySqlDataReader myReader = command.ExecuteReader();

                myReader.Read();
                Document document = new Document();
                document.id = myReader.GetInt32("id");
                document.title = myReader.GetString("title");
                string templates = myReader.GetString("templates");
                document.templates = templates.Split(',');
                myReader.Close();

                generatedDocument = generatedDocument + "<h3>" + documentId + ": " + document.title + "</h3>";

                // select keywords
                MySqlCommand getKeywords = new MySqlCommand();
                getKeywords.Connection = connection;
                getKeywords.CommandText = "SELECT * FROM keywords";

                myReader = getKeywords.ExecuteReader();

                Dictionary<string, string> keywords = new Dictionary<string, string>();
                while (myReader.Read())
                {
                    string key = myReader.GetString("kkey");
                    string value = myReader.GetString("value");
                    keywords[key] = value;
                }
                myReader.Close();


                foreach (string template in document.templates)
                {
                    System.Diagnostics.Debug.WriteLine(template);
                    MySqlCommand getTemplatesCommand = new MySqlCommand();
                    getTemplatesCommand.Connection = connection;
                    getTemplatesCommand.CommandText = "SELECT * FROM templates WHERE name = @Title ";
                    getTemplatesCommand.Parameters.AddWithValue("@Title", template);
                    System.Diagnostics.Debug.WriteLine(getTemplatesCommand.CommandText);
                    myReader = getTemplatesCommand.ExecuteReader();

                    while (myReader.Read())
                    {
                        string content = myReader.GetString("content");
                        foreach (var item in keywords)
                        {
                            content = content.Replace(item.Key, item.Value);
                        }

                        System.Diagnostics.Debug.WriteLine(content);
                        generatedDocument = generatedDocument + "<p>" + content + "</p>";

                    }
                    myReader.Close();

                }

                
            }
            catch (Exception ex)
            {
                System.Diagnostics.Debug.WriteLine(ex.Message);
            }
            return generatedDocument;
        }
    }
}