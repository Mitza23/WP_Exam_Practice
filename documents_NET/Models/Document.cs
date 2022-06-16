using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace documents_NET.Models
{
    public class Document
    {
        public int id { get; set; }
        public string title { get; set; }

        public string[] templates { get; set; }
    }
}